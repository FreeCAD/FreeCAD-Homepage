<?php

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://eu.posthog.com/api/projects/51229/persons/{$_GET["person_id"]}?delete_events=true");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer {$_SERVER["POSTHOG_API_KEY"]}"]);
    $result = curl_exec($ch);

    http_response_code(curl_getinfo($ch, CURLINFO_HTTP_CODE));
