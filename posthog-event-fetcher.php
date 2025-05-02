<?php

$cacheDurationSeconds = 30 * 60; // 30 minutes in seconds

$propertiesToTrack = [
    "mods",
    '$python_version',
    "machine",
    "screen_resolution",
    "system",
    "ui_toolbar_icon_size",
    "theme",
    "navigation_style",
    "navigation_orbit_style",
    "workbench_enabled_list",
    "workbench_default",
    "workbench_disabled_list",
    "language",
    "freecad_version"
];

function filterDisplayValue($key, $value) {
    switch($key) {
        case '$python_version':
            // Convert 3.11.4 to 3.11
            $parts = explode('.', $value);
            return implode('.', array_slice($parts, 0, 2));
        case 'system':
            // Convert Darwin to macOS
            return $value === 'Darwin' ? 'macOS' : $value;
        case 'mods':
            // Remove telemetry from the list (all users)
            return str_replace('telemetry', '', $value);
        case 'workbench_enabled_list':  // fall through
        case 'workbench_disabled_list':  // fall through
        case 'workbench_default':
            // Remove the 'Workbench' suffix
            return str_replace('Workbench', '', $value);
        case 'navigation_style':
            return str_replace(['Gui::', 'NavigationStyle'], '', $value);
        case 'navigation_orbit_style':
            switch($value) {
                case '0':
                    return 'Turntable';
                case '1':
                    return 'Trackball';
                case '2':
                    return 'Free Turntable';
                case '3':
                    return 'Trackball Classic';
                case '4':
                    return 'Rounded Arcball';
                default:
                    return 'Unknown';
            }
        default:
            return $value;
    }
}

function fetchPostHogData() {
    $apiKey = getenv('POSTHOG_API_KEY');
    $projectId = '51229';
    $url = "https://eu.posthog.com/api/projects/{$projectId}/query/";
    $startDate = date('Y-m-d', strtotime('-30 days'));
    $limit = 100;
    $offset = 0;
    $allResults = [];

    do {
        $query = [
            'query' => [
                'kind' => 'HogQLQuery',
                'query' => "
                    SELECT
                        e.distinct_id,
                        e.event,
                        toString(e.properties) AS properties_json,
                        e.timestamp
                    FROM events e
                    JOIN (
                        SELECT
                            distinct_id,
                            event,
                            max(timestamp) AS latest_ts
                        FROM events
                        WHERE timestamp >= '$startDate'
                        GROUP BY distinct_id, event
                    ) latest ON e.distinct_id = latest.distinct_id AND e.timestamp = latest.latest_ts AND e.event = latest.event
                    ORDER BY e.timestamp DESC
                    LIMIT $limit OFFSET $offset
                "
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));
        $response = curl_exec($ch);

        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch) . "\n";
            curl_close($ch);
            exit;
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            echo "API Error: HTTP $httpCode\n";
            echo "Response: $response\n";
            exit;
        }

        $data = json_decode($response, true);
        $results = $data['results'] ?? [];

        if (!empty($results)) {
            foreach ($results as &$event) {
                $event = [
                    'distinct_id' => $event[0],
                    'event' => $event[1],
                    'properties' => json_decode($event[2], true),
                    'timestamp' => $event[3],
                ];
            }
            $allResults = array_merge($allResults, $results);
            $offset += $limit;
        } else {
            break;
        }

    } while (count($results) === $limit);

    return $allResults;
}

$filename = 'chart_data.json';

if (file_exists($filename)) {
    $lastModified = filemtime($filename);
    $scriptModified = filemtime(__FILE__);

    $isDataStale = (time() - $lastModified) >= $cacheDurationSeconds;
    $isScriptModified = $scriptModified > $lastModified;

    if (!$isDataStale && !$isScriptModified) {
        echo "The file '$filename' was updated less than 30 minutes ago and the script hasn't been modified. No new request sent.\n";
        exit;
    }
}

$allResults = fetchPostHogData();
usort($allResults, function ($a, $b) {
    return strtotime($a['timestamp']) <=> strtotime($b['timestamp']);
});

$userMap = [];
foreach ($allResults as $entry) {
    $id = $entry['distinct_id'];
    $props = $entry['properties'] ?? [];

    if (!isset($userMap[$id])) $userMap[$id] = [];

    // Handle version combination first
    if (isset($props['version_major']) && isset($props['version_minor']) && isset($props['version_patch'])) {
        $version = $props['version_major'] . '.' . $props['version_minor'] . '.' . $props['version_patch'];
        $userMap[$id]['freecad_version'] = $version;
    }

    foreach ($props as $key => $val) {
        // Skip individual version components as they're handled above
        if ($key === 'version_major' || $key === 'version_minor' || $key === 'version_patch') continue;

        if (!in_array($key, $propertiesToTrack)) continue;

        if (is_array($val)) {
            if (!isset($userMap[$id][$key])) $userMap[$id][$key] = [];
            foreach ($val as $v) {
                // Apply filter to each array value
                $filteredValue = filterDisplayValue($key, $v);
                // Only add non-empty values
                if (!empty(trim($filteredValue))) {
                    $userMap[$id][$key][$filteredValue] = true;
                }
            }
        } else {
            // Apply filter to single value
            $filteredValue = filterDisplayValue($key, $val);
            // Only add non-empty values
            if (!empty(trim($filteredValue))) {
                $userMap[$id][$key] = $filteredValue;
            }
        }
    }
}

$totalUsers = count($userMap);
$chartData = [];

foreach ($propertiesToTrack as $key) {
    $counts = [];

    foreach ($userMap as $props) {
        if (!isset($props[$key])) continue;

        $val = $props[$key];

        if (is_array($val)) {
            foreach ($val as $item => $_) {
                // Only count non-empty values
                if (!empty(trim($item))) {
                    $counts[$item] = ($counts[$item] ?? 0) + 1;
                }
            }
        } else {
            // Only count non-empty values
            if (!empty(trim($val))) {
                $counts[$val] = ($counts[$val] ?? 0) + 1;
            }
        }
    }

    arsort($counts);

    $chartData[$key] = [
        'labels' => array_keys($counts),
        'data' => array_values($counts),
        'totalUsers' => $totalUsers
    ];
}

file_put_contents($filename, json_encode($chartData));
echo "Chart data written to '$filename'.\n";

?>
