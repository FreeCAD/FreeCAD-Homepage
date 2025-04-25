<?php

$filename = 'posthog_events.json';

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
			$hashedId = hash_hmac('sha256', $event[0], $apiKey);
            $event = [
                'distinct_id' => $hashedId,
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

file_put_contents($filename, json_encode($allResults));
echo "Data successfully saved to '$filename'. Total rows: " . count($allResults) . "\n";

?>
