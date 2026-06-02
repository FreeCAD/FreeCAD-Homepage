<?php

$stripeSecretKey = getenv('STRIPE_SECRET_KEY');
$fallbackUrl = 'https://donate.stripe.com/14k3ei9TYgwFclq145';

$amount = $_GET['amount'] ?? null;
$currency = strtolower((string) ($_GET['currency'] ?? 'eur'));
if (!is_numeric($amount) || !in_array($currency, ['eur', 'usd'], true)) {
    header('Location: ' . $fallbackUrl, true, 303);
    exit;
}

$amount = (float) $amount;

if ($amount < 1 || $amount > 10000) {
    header('Location: ' . $fallbackUrl, true, 303);
    exit;
}

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? '';
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');

if ($host === '') {
    header('Location: ' . $fallbackUrl, true, 303);
    exit;
}

$baseUrl = $scheme . '://' . $host . ($basePath === '' ? '' : $basePath);
$successUrl = $baseUrl . '/thankyou.php?stripe=success&session_id={CHECKOUT_SESSION_ID}';
$cancelUrl = $baseUrl . '/?stripe_cancel=1';
$referer = $_SERVER['HTTP_REFERER'] ?? '';
$refererParts = parse_url($referer);

if (!empty($refererParts['host']) && strcasecmp($refererParts['host'], $host) === 0) {
    $separator = isset($refererParts['query']) && $refererParts['query'] !== '' ? '&' : '?';
    $cancelUrl = $referer . $separator . 'stripe_cancel=1';
}

$postFields = http_build_query([
    'mode' => 'payment',
    'success_url' => $successUrl,
    'cancel_url' => $cancelUrl,
    'line_items[0][quantity]' => 1,
    'line_items[0][price_data][currency]' => $currency,
    'line_items[0][price_data][unit_amount]' => (int) round($amount * 100),
    'line_items[0][price_data][product_data][name]' => (_('FreeCAD Donation')),
    'metadata[donation_type]' => 'donation',
    'metadata[source]' => 'website',
]);

$headers = [
    'Authorization: Bearer ' . $stripeSecretKey,
    'Content-Type: application/x-www-form-urlencoded',
];

$response = null;

if (function_exists('curl_init')) {
    $ch = curl_init('https://api.stripe.com/v1/checkout/sessions');
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postFields,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 15,
    ]);
    $response = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if ($response === false) {
        $transportError = curl_error($ch);
        error_log('[stripe-checkout] cURL error: ' . $transportError);
    }

    
    curl_close($ch);
} else {
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => implode("\r\n", $headers),
            'content' => $postFields,
            'timeout' => 15,
            'ignore_errors' => true,
        ],
    ]);
    $response = file_get_contents('https://api.stripe.com/v1/checkout/sessions', false, $context);
    $statusCode = 0;

    if (isset($http_response_header[0]) && preg_match('/\s(\d{3})\s/', $http_response_header[0], $matches)) {
        $statusCode = (int) $matches[1];
    }
}

$data = json_decode((string) $response, true);

if ($statusCode >= 200 && $statusCode < 300 && !empty($data['url'])) {
    header('Location: ' . $data['url'], true, 303);
    exit;
}

header('Location: ' . $fallbackUrl, true, 303);
exit;
