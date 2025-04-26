<?php

$filename = 'chart_data.json';
if (file_exists($filename)) {
    $lastModified = filemtime($filename);
    if ((time() - $lastModified) < 1800) {
        echo "The file '$filename' was updated less than 30 minutes ago. No new request sent.\n";
        exit;
    }
}

$apiKey = getenv('POSTHOG_API_KEY');
$projectId = '51229';
$url = "https://eu.posthog.com/api/projects/{$projectId}/query/";
$startDate = date('Y-m-d', strtotime('-30 days'));
$limit = 100;
$offset = 0;
$allResults = [];

$propertiesToTrack = [
    "mods",
    "python_version__minor",
    "machine",
    "screen_resolution",
    "system",
    "ui_toolbar_icon_size",
    "theme",
    "navigation_style",
    "workbench_enabled_list",
    "workbench_default",
    "workbench_disabled_list",
    "language"
];

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
                'timestamp' => $event[3]
            ];
        }
        $allResults = array_merge($allResults, $results);
        $offset += $limit;
    } else {
        break;
    }

} while (count($results) === $limit);

usort($allResults, function ($a, $b) {
    return strtotime($a['timestamp']) <=> strtotime($b['timestamp']);
});

$userMap = [];
foreach ($allResults as $entry) {
    $id = $entry['distinct_id'];
    $props = $entry['properties'] ?? [];

    if (!isset($userMap[$id])) $userMap[$id] = [];

    foreach ($props as $key => $val) {
        if (!in_array($key, $propertiesToTrack)) continue;

        if (is_array($val)) {
            if (!isset($userMap[$id][$key])) $userMap[$id][$key] = [];
            foreach ($val as $v) {
                $userMap[$id][$key][$v] = true;
            }
        } else {
            $userMap[$id][$key] = $val;
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
                $counts[$item] = ($counts[$item] ?? 0) + 1;
            }
        } else {
            $counts[$val] = ($counts[$val] ?? 0) + 1;
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
