<?php

$stripeSecretKey = getenv('STRIPE_SECRET_KEY');
$outputFile = __DIR__ . '/stripe-donations.json';
$limit = 10;
$minimumRefreshSeconds = 60;

function send_json($data)
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}

function send_file($file)
{
    header('Content-Type: application/json; charset=utf-8');
    readfile($file);
    exit;
}

if (is_file($outputFile) && time() - filemtime($outputFile) < $minimumRefreshSeconds) {
    send_file($outputFile);
}

if (!function_exists('curl_init')) {
    send_json([
        'ok' => true,
        'updated_at' => time(),
        'donations' => [],
    ]);
}

$url = 'https://api.stripe.com/v1/checkout/sessions?' . http_build_query([
    'limit' => $limit,
    'status' => 'complete',
]);

$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_HTTPGET => true,
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . $stripeSecretKey,
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 20,
]);

$response = curl_exec($ch);
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = $response === false ? curl_error($ch) : '';

curl_close($ch);

$data = json_decode((string) $response, true);

if ($curlError !== '' || $statusCode < 200 || $statusCode >= 300 || !is_array($data)) {
    if (is_file($outputFile)) {
        send_file($outputFile);
    }

    send_json([
        'ok' => true,
        'updated_at' => time(),
        'donations' => [],
    ]);
}

$donations = [];

foreach (($data['data'] ?? []) as $session) {
    if (($session['status'] ?? '') !== 'complete') {
        continue;
    }

    $amountTotal = (int) ($session['amount_total'] ?? 0);
    $currency = strtolower((string) ($session['currency'] ?? 'eur'));
    $created = (int) ($session['created'] ?? time());

    if ($amountTotal <= 0 || !in_array($currency, ['eur', 'usd'], true)) {
        continue;
    }

    $donations[] = [
        'id' => $session['id'] ?? '',
        'amount' => $amountTotal / 100,
        'currency' => $currency,
        'created' => $created,
    ];
}

$output = [
    'ok' => true,
    'updated_at' => time(),
    'donations' => $donations,
];

file_put_contents(
    $outputFile,
    json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
    LOCK_EX
);

send_json($output);
