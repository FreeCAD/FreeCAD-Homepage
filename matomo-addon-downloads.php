<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

$endpoint = 'https://addons.freecad.org/stats/index.php';
$token = getenv('MATOMO_TOKEN');

$label  = urldecode((string)($_GET['label'] ?? ''));
$period = (string)($_GET['period'] ?? 'day');
$metric = (string)($_GET['metric'] ?? 'nb_hits');
$start  = (string)($_GET['start'] ?? date('Y-m-d', strtotime('-30 days')));
$end    = (string)($_GET['end'] ?? date('Y-m-d'));

if ($label === '') { $label = 'addons.freecad.org &gt; @%2FCatalogCache%2FAddonManager%2F0-main.zip'; }
if (!in_array($period, ['day','week','month'], true)) $period = 'day';
if (!in_array($metric, ['nb_hits','nb_visits'], true)) $metric = 'nb_hits';

$params = [
  'module' => 'API',
  'format' => 'JSON',
  'idSite' => 1,
  'period' => $period,
  'date' => $start . ',' . $end,
  'method' => 'Actions.getDownloads',
  'label' => $label,
  'filter_limit' => -1,
  'format_metrics' => 0,
  'expanded' => 1,
  'showMetadata' => 0,
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
if (!is_array($data)) { echo '[]'; exit; }

$series = [];

foreach ($data as $k => $v) {
  $value = 0;

  if (is_array($v)) {
    if (isset($v[$metric])) $value = (int)$v[$metric];
    elseif (isset($v[0]) && is_array($v[0]) && isset($v[0][$metric])) $value = (int)$v[0][$metric];
  } else {
    $value = (int)$v;
  }

  $series[] = ['label' => (string)$k, 'value' => $value];
}

usort($series, function($a, $b) { return strcmp($a['label'], $b['label']); });

echo json_encode($series, JSON_UNESCAPED_UNICODE);
