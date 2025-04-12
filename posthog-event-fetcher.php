<?php

$filename = 'posthog_events.json';

if (file_exists($filename)) {
    $lastModified = filemtime($filename);
    $now = time();
    $minutesSinceLastUpdate = ($now - $lastModified) / 60;

    if ($minutesSinceLastUpdate < 30) {
        echo "The file '$filename' was updated less than 30 minutes ago. No new request sent.\n";
        exit;
    }
}

$baseUrl = 'https://eu.posthog.com/api/event/';
$apiKey = getenv('POSTHOG_API_KEY');
$allResults = [];
$url = $baseUrl . '?limit=500&after=' . urlencode(date('Y-m-d\TH:i:s\Z', strtotime('-30 days')));
$hasError = false;

do {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $apiKey,
    ]);

    $response = curl_exec($ch);

    if ($response === false) {
        echo 'cURL Error: ' . curl_error($ch) . "\n";
        $hasError = true;
        curl_close($ch);
        break;
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($httpCode === 429) {
        echo "Rate limit reached (HTTP 429). Waiting 10 seconds before retrying...\n";
        curl_close($ch);
        sleep(10);
        continue;
    }

    if ($httpCode !== 200) {
        echo "API Error: Received HTTP status code $httpCode\n";
        $hasError = true;
        curl_close($ch);
        break;
    }

    $responseData = json_decode($response, true);
    curl_close($ch);

    if (isset($responseData['results'])) {
        $allResults = array_merge($allResults, $responseData['results']);
    }

    $url = $responseData['next'] ?? null;

    sleep(1);

} while ($url);

if ($hasError) {
    echo "No data was saved due to an error during the API request.\n";
} else {
    file_put_contents($filename, json_encode($allResults, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    echo "Data successfully saved to $filename. Total events: " . count($allResults) . "\n";
}
?>
