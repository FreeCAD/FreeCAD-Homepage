<?php

$cacheDurationSeconds = 30 * 60; // 30 minutes in seconds

$propertiesToTrack = [
    'mods',
    '$python_version',
    'machine',
    'screen_resolution',
    'system',
    'ui_toolbar_icon_size',
    'theme',
    'navigation_style',
    'navigation_orbit_style',
    'workbench_enabled_list',
    'workbench_default',
    'workbench_disabled_list',
    'language',
    'freecad_version',
];

function fetchPostHogData()
{
    $apiKey = getenv('POSTHOG_API_KEY');

    $projectId = '51229';
    $url = "https://eu.posthog.com/api/projects/{$projectId}/query/";
    $startDate = date('Y-m-d', strtotime('-30 days'));

    $hogqlTemplate = <<<'SQL'
WITH
    toDate('{start_date}') AS start_date,
    prop_rows AS (
        -- 1) mods (array, remove 'telemetry')
        SELECT
            distinct_id,
            'mods' AS property,
            replace(
                JSONExtractString(mod),
                'telemetry',
                ''
            ) AS value
        FROM events
        ARRAY JOIN arrayDistinct(
            JSONExtractArrayRaw(properties, 'mods')
        ) AS mod
        WHERE timestamp >= start_date
          AND event = 'freecad_addon_list'

        UNION ALL

        -- 2) $python_version (last seen, 3.11.4 -> 3.11 using regex)
        SELECT
            distinct_id,
            '$python_version' AS property,
            argMax(
                extract(
                    JSONExtractString(properties, '$python_version'),
                    '^(\\d+\\.\\d+)'
                ),
                timestamp
            ) AS value
        FROM events
        WHERE timestamp >= start_date
          AND JSONExtractString(properties, '$python_version') != ''
        GROUP BY distinct_id

        UNION ALL

        -- 3) machine (last seen)
        SELECT
            distinct_id,
            'machine' AS property,
            argMax(
                JSONExtractString(properties, 'machine'),
                timestamp
            ) AS value
        FROM events
        WHERE timestamp >= start_date
          AND event = 'freecad_system_info'
          AND JSONExtractString(properties, 'machine') != ''
        GROUP BY distinct_id

        UNION ALL

        -- 4) screen_resolution (last seen)
        SELECT
            distinct_id,
            'screen_resolution' AS property,
            argMax(
                JSONExtractString(properties, 'screen_resolution'),
                timestamp
            ) AS value
        FROM events
        WHERE timestamp >= start_date
          AND event = 'freecad_system_info'
          AND JSONExtractString(properties, 'screen_resolution') != ''
        GROUP BY distinct_id

        UNION ALL

        -- 5) system (last seen, Darwin -> macOS)
        SELECT
            distinct_id,
            'system' AS property,
            argMax(
                if(
                    JSONExtractString(properties, 'system') = 'Darwin',
                    'macOS',
                    JSONExtractString(properties, 'system')
                ),
                timestamp
            ) AS value
        FROM events
        WHERE timestamp >= start_date
          AND event = 'freecad_system_info'
          AND JSONExtractString(properties, 'system') != ''
        GROUP BY distinct_id

        UNION ALL

        -- 6) ui_toolbar_icon_size (last seen, int -> string)
        SELECT
            distinct_id,
            'ui_toolbar_icon_size' AS property,
            argMax(
                toString(JSONExtractInt(properties, 'ui_toolbar_icon_size')),
                timestamp
            ) AS value
        FROM events
        WHERE timestamp >= start_date
          AND event = 'freecad_preferences'
          AND isNotNull(JSONExtractInt(properties, 'ui_toolbar_icon_size'))
        GROUP BY distinct_id

        UNION ALL

        -- 7) theme (last seen)
        SELECT
            distinct_id,
            'theme' AS property,
            argMax(
                JSONExtractString(properties, 'theme'),
                timestamp
            ) AS value
        FROM events
        WHERE timestamp >= start_date
          AND event = 'freecad_preferences'
          AND JSONExtractString(properties, 'theme') != ''
        GROUP BY distinct_id

        UNION ALL

        -- 8) navigation_style (last seen, clean name)
        SELECT
            distinct_id,
            'navigation_style' AS property,
            argMax(
                replace(
                    replace(JSONExtractString(properties, 'navigation_style'), 'Gui::', ''),
                    'NavigationStyle',
                    ''
                ),
                timestamp
            ) AS value
        FROM events
        WHERE timestamp >= start_date
          AND event = 'freecad_preferences'
          AND JSONExtractString(properties, 'navigation_style') != ''
        GROUP BY distinct_id

        UNION ALL

        -- 9) navigation_orbit_style (last seen, map 0..4 to label)
        SELECT
            distinct_id,
            'navigation_orbit_style' AS property,
            argMax(
                CASE JSONExtractInt(properties, 'navigation_orbit_style')
                    WHEN 0 THEN 'Turntable'
                    WHEN 1 THEN 'Trackball'
                    WHEN 2 THEN 'Free Turntable'
                    WHEN 3 THEN 'Trackball Classic'
                    WHEN 4 THEN 'Rounded Arcball'
                    ELSE 'Unknown'
                END,
                timestamp
            ) AS value
        FROM events
        WHERE timestamp >= start_date
          AND event = 'freecad_preferences'
          AND isNotNull(JSONExtractInt(properties, 'navigation_orbit_style'))
        GROUP BY distinct_id

        UNION ALL

        -- 10) workbench_enabled_list (array, remove 'Workbench')
        SELECT
            distinct_id,
            'workbench_enabled_list' AS property,
            replace(
                JSONExtractString(wb),
                'Workbench',
                ''
            ) AS value
        FROM events
        ARRAY JOIN arrayDistinct(
            JSONExtractArrayRaw(properties, 'workbench_enabled_list')
        ) AS wb
        WHERE timestamp >= start_date
          AND event = 'freecad_preferences'

        UNION ALL

        -- 11) workbench_disabled_list (array, remove 'Workbench')
        SELECT
            distinct_id,
            'workbench_disabled_list' AS property,
            replace(
                JSONExtractString(wb),
                'Workbench',
                ''
            ) AS value
        FROM events
        ARRAY JOIN arrayDistinct(
            JSONExtractArrayRaw(properties, 'workbench_disabled_list')
        ) AS wb
        WHERE timestamp >= start_date
          AND event = 'freecad_preferences'

        UNION ALL

        -- 12) workbench_default (last seen, remove 'Workbench')
        SELECT
            distinct_id,
            'workbench_default' AS property,
            argMax(
                replace(
                    JSONExtractString(properties, 'workbench_default'),
                    'Workbench',
                    ''
                ),
                timestamp
            ) AS value
        FROM events
        WHERE timestamp >= start_date
          AND event = 'freecad_preferences'
          AND JSONExtractString(properties, 'workbench_default') != ''
        GROUP BY distinct_id

        UNION ALL

        -- 13) language (last seen)
        SELECT
            distinct_id,
            'language' AS property,
            argMax(
                JSONExtractString(properties, 'language'),
                timestamp
            ) AS value
        FROM events
        WHERE timestamp >= start_date
          AND event = 'freecad_preferences'
          AND JSONExtractString(properties, 'language') != ''
        GROUP BY distinct_id

        UNION ALL

        -- 14) freecad_version (last seen, combine major.minor.patch)
        SELECT
            distinct_id,
            'freecad_version' AS property,
            argMax(
                concat(
                    toString(JSONExtractInt(properties, 'version_major')),
                    '.',
                    toString(JSONExtractInt(properties, 'version_minor')),
                    '.',
                    toString(JSONExtractInt(properties, 'version_patch'))
                ),
                timestamp
            ) AS value
        FROM events
        WHERE timestamp >= start_date
          AND event = 'freecad_version'
          AND isNotNull(JSONExtractInt(properties, 'version_major'))
          AND isNotNull(JSONExtractInt(properties, 'version_minor'))
          AND isNotNull(JSONExtractInt(properties, 'version_patch'))
        GROUP BY distinct_id
    )
SELECT
    property,
    value,
    count(DISTINCT distinct_id) AS users
FROM (
    SELECT distinct_id, property, value
    FROM prop_rows

    UNION ALL

    -- Extra rows used to compute total unique users
    SELECT
        distinct_id,
        '_totalUsers' AS property,
        'ALL' AS value
    FROM prop_rows
    GROUP BY distinct_id
) AS all_rows
WHERE value != '' AND value IS NOT NULL
GROUP BY property, value
ORDER BY property, users DESC
LIMIT 50000
SQL;

    $hogql = str_replace('{start_date}', $startDate, $hogqlTemplate);

    $body = [
        'query' => [
            'kind'  => 'HogQLQuery',
            'query' => $hogql,
        ],
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

    $response = curl_exec($ch);

    if ($response === false) {
        echo 'cURL error: ' . curl_error($ch) . "\n";
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
    if (!is_array($data) || !isset($data['results']) || !is_array($data['results'])) {
        echo 'Unexpected PostHog response.' . "\n";
        var_dump($data);
        exit;
    }

    return $data['results'];
}

function buildChartData($rows, $propertiesToTrack)
{
    $chartData  = [];
    $totalUsers = 0;

    foreach ($rows as $row) {
        if (!is_array($row) || count($row) < 3) {
            // Skip invalid rows
            continue;
        }

        $property = $row[0];
        $value    = $row[1];
        $users    = (int)$row[2];

        if ($property === '_totalUsers') {
            // Store global unique user count
            $totalUsers = $users;
            continue;
        }

        // Only include properties we explicitly track
        if (!in_array($property, $propertiesToTrack, true)) {
            continue;
        }

        // Skip empty values
        if ($value === '' || $value === null) {
            continue;
        }

        if (!isset($chartData[$property])) {
            $chartData[$property] = [
                'labels'     => [],
                'data'       => [],
                'totalUsers' => 0,
            ];
        }

        $chartData[$property]['labels'][] = (string)$value;
        $chartData[$property]['data'][]   = $users;
    }

    foreach ($chartData as $key => $entry) {
        $chartData[$key]['totalUsers'] = $totalUsers;
    }

    return $chartData;
}

$filename = 'chart_data.json';

if (file_exists($filename)) {
    $lastModified   = filemtime($filename);
    $scriptModified = filemtime(__FILE__);

    $isDataStale      = (time() - $lastModified) >= $cacheDurationSeconds;
    $isScriptModified = $scriptModified > $lastModified;

}

$rows      = fetchPostHogData();
$chartData = buildChartData($rows, $propertiesToTrack);

file_put_contents($filename, json_encode($chartData));
echo "Chart data written to '$filename'.\n";

?>

