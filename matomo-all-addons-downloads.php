<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

function walkAddons($rows, array &$totals): void
{
    if (!is_array($rows)) return;

    foreach ($rows as $row) {
        if (!is_array($row)) continue;

        $label = (string)($row['label'] ?? '');
        $hits  = (int)($row['nb_hits'] ?? 0);

        if (preg_match('~CatalogCache/([^/]+)/~', $label, $m)) {
            $addon = strtolower(preg_replace('~[^a-z0-9._-]+~i', '', $m[1]));
            $totals[$addon] = ($totals[$addon] ?? 0) + $hits;
        }

        if (isset($row['subtable']) && is_array($row['subtable'])) {
            walkAddons($row['subtable'], $totals);
        }
    }
}

$endpoint = 'https://addons.freecad.org/stats/index.php';
$token = getenv('MATOMO_TOKEN');

$period = $_GET['period'] ?? 'range';
$date   = $_GET['date']   ?? 'last30';

$allowedPeriods = ['day','week','month','year','range'];
if (!in_array($period, $allowedPeriods, true)) $period = 'range';
if (!is_string($date) || $date === '' || strlen($date) > 64) $date = 'last30';

$params = [
    'module' => 'API',
    'format' => 'JSON',
    'idSite' => 1,
    'period' => $period,
    'date' => $date,
    'method' => 'Actions.getDownloads',
    'expanded' => 1,
    'showMetadata' => 0,
    'filter_limit' => -1,
    'token_auth' => $token,
];

$ch = curl_init($endpoint);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($params),
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_SSL_VERIFYPEER => true,
]);

$raw = curl_exec($ch);
curl_close($ch);

$data = json_decode((string)$raw, true);

$totals = [];
walkAddons($data, $totals);
arsort($totals);

echo json_encode($totals, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
