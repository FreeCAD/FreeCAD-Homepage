<?php

    // Destructive operation: the addon issues an HTTP DELETE, so reject anything
    // else to shut off bare GET crawls, link prefetch, and <img>-style CSRF.
    if ($_SERVER["REQUEST_METHOD"] !== "DELETE") {
        http_response_code(405);
        exit;
    }

    // Require a well-formed UUIDv4 person_id so that an empty/missing/malformed
    // value can never fall through to results[0].
    $distinct_id = $_GET["person_id"] ?? "";
    if (!preg_match('/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-4[0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/', $distinct_id)) {
        http_response_code(400);
        exit;
    }

    $project_id = 51229;
    $api_key = $_SERVER["POSTHOG_API_KEY"] ?? "";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://eu.posthog.com/api/projects/{$project_id}/persons/?distinct_id=" . urlencode($distinct_id));
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json", "Authorization: Bearer {$api_key}"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $data = json_decode($result, true);
    curl_close($ch);

    // Require exactly one match that actually owns this distinct_id before deleting.
    $results = $data['results'] ?? [];
    if (count($results) !== 1 || !in_array($distinct_id, $results[0]['distinct_ids'] ?? [], true)) {
        http_response_code(404);
        exit;
    }
    $uuid = $results[0]['uuid'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://eu.posthog.com/api/projects/{$project_id}/persons/" . urlencode($uuid) . "?delete_events=true");
    curl_setopt($ch, CURLOPT_HTTPGET, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer {$api_key}"]);
    $result = curl_exec($ch);

    http_response_code(curl_getinfo($ch, CURLINFO_HTTP_CODE));
