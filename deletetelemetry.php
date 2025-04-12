<?php

    $ch = curl_init();

    $distinct_id = $_GET["person_id"];
    $project_id = 51229;

    curl_setopt($ch, CURLOPT_URL, "https://eu.posthog.com/api/projects/{$project_id}/persons/?distinct_id={$distinct_id}");
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json", "Authorization: Bearer {$_SERVER["POSTHOG_API_KEY"]}"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $data = json_decode($result, true);
    $uuid = $data['results'][0]['uuid'] ?? null;
    curl_close($ch);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://eu.posthog.com/api/projects/{$project_id}/persons/{$uuid}?delete_events=true");
    curl_setopt($ch, CURLOPT_HTTPGET, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer {$_SERVER["POSTHOG_API_KEY"]}"]);
    $result = curl_exec($ch);

    http_response_code(curl_getinfo($ch, CURLINFO_HTTP_CODE));
