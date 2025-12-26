<?php
$currentpage = "addons.php";
include("header.php");
?>

<style>
  .card{
    background-color: rgba(52, 58, 64, 0.5);
  }
  .addon-logo{
    max-width:64px;
    min-width:64px;
    height:64px;
    border-radius:50%;
    display:grid; place-items:center;
    background:
      radial-gradient(60% 60% at 30% 30%, rgba(255,255,255,.12), transparent 60%),
      linear-gradient(135deg, #1c2530 0%, #0e1217 100%);
    border:1px solid rgba(255,255,255,.14);
    box-shadow: inset 0 2px 6px rgba(0,0,0,.35), 0 4px 12px rgba(0,0,0,.18);
  }
  .addon-logo img{
    width:72%;
    height:72%;
    object-fit:contain;
  }

@media (max-width: 400px){
  .card .d-flex.align-items-start.gap-3.mb-3{
    flex-direction: column;
    align-items: flex-start;
    gap: .75rem;
  }
  .card .d-flex.align-items-start.gap-3.mb-3 .min-w-0{
    width: 100%;
  }
  .card .addon-logo{
    margin-left: auto;
    margin-right: auto;
  }
}
</style>

<?php
$zipUrl = 'http://addons.freecad.org/addon_catalog_cache.zip';
$addonsMap = [];
$tmpZip = tempnam(sys_get_temp_dir(), 'fc_zip_');
$data = null;

if (function_exists('curl_init')) {
  $ch = curl_init($zipUrl);
  curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_TIMEOUT        => 20,
  ]);
  $data = curl_exec($ch);
  curl_close($ch);
} else {
  $data = @file_get_contents($zipUrl);
}

if ($data) {
  file_put_contents($tmpZip, $data);
  $zip = new ZipArchive();
  if ($zip->open($tmpZip) === true) {
    $jsonContent = null;
    for ($i = 0; $i < $zip->numFiles; $i++) {
      $n = $zip->getNameIndex($i);
      if (preg_match('~\.json$~i', $n)) {
        $jsonContent = $zip->getFromIndex($i);
        break;
      }
    }
    if ($jsonContent !== null) {
      $parsed = json_decode($jsonContent, true);
      if (is_array($parsed)) $addonsMap = $parsed;
    }
    $zip->close();
  }
  @unlink($tmpZip);
}

function esc($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function toArray($v){ return is_array($v) ? $v : (($v!=='' && $v!==null) ? [$v] : []); }

function getValue($arr, $paths, $default=''){
  foreach ((array)$paths as $path) {
    $cur = $arr;
    foreach (explode('.', $path) as $k) {
      if (is_array($cur) && array_key_exists($k, $cur)) {
        $cur = $cur[$k];
      } else {
        $cur = null;
        break;
      }
    }
    if ($cur !== null && $cur !== '') return $cur;
  }
  return $default;
}

function firstOfArray($v){
	if (is_array($v)) {
		$vals = array_values($v);
		$first = $vals[0] ?? '';
		return is_scalar($first) ? (string)$first : '';
	}
	return is_scalar($v) ? (string)$v : '';
}

function normalizeAddonId($s){
    $s = (string)$s;
    $s = strtolower($s);
    $s = preg_replace('~[^a-z0-9._-]+~i', '', $s);
    return $s ?: '';
}

function fetchAddonDownloadTotals($url){
    $raw = null;

    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_TIMEOUT        => 10,
        ]);
        $raw = curl_exec($ch);
        $http = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($raw === false || $http < 200 || $http >= 300) $raw = null;
    } else {
        $raw = @file_get_contents($url);
    }

    $decoded = $raw ? json_decode($raw, true) : null;
    if (!is_array($decoded)) return [];

    $out = [];
    foreach ($decoded as $k => $v) {
        $id = normalizeAddonId($k);
        if ($id === '') continue;
        $out[$id] = (int)$v;
    }
    return $out;
}

$downloadsBase = 'https://www.freecad.org/matomo-all-addons-downloads.php';
$downloadsLast30Days = fetchAddonDownloadTotals($downloadsBase . '?period=range&date=last30');
$downloadsLast90Days = fetchAddonDownloadTotals($downloadsBase . '?period=range&date=last90');
$downloadsAllTime = fetchAddonDownloadTotals($downloadsBase . '?period=range&date=2016-01-01,today');

$sortedAddonsMap = [];

foreach ($addonsMap as $addonKey => $entries) {
	if (!is_array($entries) || empty($entries)) continue;
	$entry = $entries[0];

	$rawLast = isset($entry['last_update_time']) ? (string)$entry['last_update_time'] : '';
	$ts = $rawLast !== '' ? (strtotime($rawLast) ?: 0) : 0;

	$sortedAddonsMap[] = [
		'key'      => $addonKey,
		'entries'  => $entries,
		'ts'       => $ts,
		'last_raw' => $rawLast
	];
}

usort($sortedAddonsMap, function($a, $b){
	return $b['ts'] <=> $a['ts'];
})
?>

<main id="main" class="container-fluid">
  <div class="download-notes text-center">
    <h2 class="features-title"><?php echo _('Addons'); ?></h2>
  </div>

  <div class="row g-3 row-cols-1 row-cols-lg-2">
    <?php foreach ($sortedAddonsMap as $row):
      $addonKey = $row['key'];
      $entries  = $row['entries'];
      if (!is_array($entries) || empty($entries)) continue;
      $entry = $entries[0];

      $xmlArr = [];
      if (isset($entry['metadata']['package_xml']) && $entry['metadata']['package_xml']) {
        $xml = @simplexml_load_string($entry['metadata']['package_xml']);
        if ($xml) $xmlArr = json_decode(json_encode($xml), true) ?: [];
      }

      $nameRaw        = getValue($xmlArr, ['name'], (string)$addonKey);
      $descriptionRaw = getValue($xmlArr, ['description'], '');
      $name        = trim(firstOfArray($nameRaw));
      if ($name === '') $name = (string)$addonKey;
      $description = trim(firstOfArray($descriptionRaw));
      $version      = getValue($xmlArr, ['version'], '');
      $date         = getValue($xmlArr, ['date'], getValue($entry, ['last_update_time'], ''));
      $license      = getValue($xmlArr, ['license','content.workbench.license'], '');
      $maintainer   = getValue($xmlArr, ['maintainer'], '');
      $repositoryUrl= getValue($entry, ['repository'], '');

      $iconUrl = null;
      $iconDataB64 = getValue($entry, ['metadata.icon_data'], '');
      if ($iconDataB64) {
        $prefix = 'image/svg+xml';
        if (str_starts_with($iconDataB64, 'iVBORw0')) $prefix = 'image/png';
        elseif (str_starts_with($iconDataB64, '/9j/')) $prefix = 'image/jpeg';
        elseif (str_starts_with($iconDataB64, 'R0lGOD')) $prefix = 'image/gif';
        $iconUrl = 'data:' . $prefix . ';base64,' . $iconDataB64;
      }

      $addonId = normalizeAddonId($addonKey);
      $d30 = (int)($downloadsLast30Days[$addonId] ?? 0);
      $d90 = (int)($downloadsLast90Days[$addonId] ?? 0);
      $da = (int)($downloadsAllTime[$addonId] ?? 0);
    ?>
      <div class="col">
        <div class="card h-100 position-relative text-light">
          <div class="card-body">
            <div class="d-flex align-items-start gap-3 mb-3">
              <?php if ($iconUrl): ?>
                <div class="addon-logo">
                  <img src="<?= esc($iconUrl) ?>" alt="" loading="lazy" decoding="async">
                </div>
              <?php endif; ?>
              <div class="min-w-0">
                <h5 class="card-title" title="<?= esc($name) ?>"><?= esc($name) ?></h5>
                <?php if ($maintainer): ?>
                  <div class="text-white-50 small"><?= esc(is_array($maintainer) ? ($maintainer[0] ?? '') : $maintainer) ?></div>
                <?php endif; ?>
              </div>
            </div>

            <?php if ($description): ?>
              <p class="card-text mb-3"><?= esc($description) ?></p>
            <?php endif; ?>

            <div class="small mb-0">
              <?php if ($version): ?>
                <span class="me-2"><?php echo _('Version:'); ?> <?= esc($version) ?></span>
              <?php endif; ?>

              <?php
                $displayDate = '';
                $lastUpdateRaw = getValue($entry, ['last_update_time'], '');
                if ($lastUpdateRaw) {
                	$t = strtotime($lastUpdateRaw);
                	if ($t) $displayDate = date('Y-m-d', $t);
                }
              ?>

              <?php if ($displayDate): ?>
                <span class="me-2"><?php echo _('Last update:'); ?> <?= esc($displayDate) ?></span>
              <?php endif; ?>

              <?php if ($license): ?>
                <span class="me-2"><?php echo _('License:'); ?> <?= esc(is_array($license) ? ($license[0] ?? '') : $license) ?></span>
              <?php endif; ?>
            </div>

            <?php if ($d30 || $d90 || $da): ?>
              <div class="small mt-3 d-flex flex-row flex-nowrap align-items-baseline gap-2 overflow-auto">
                <div class="text-white-50">Downloads</div>
                <?php if ($d30): ?><div>&bull; 30 days: <?= esc($d30) ?></div><?php endif; ?>
                <?php if ($d90): ?><div>&bull; 90 days: <?= esc($d90) ?></div><?php endif; ?>
                <?php if ($da):  ?><div>&bull; All time: <?= esc($da) ?></div><?php endif; ?>
              </div>
            <?php endif; ?>
          </div>

          <?php if ($repositoryUrl): ?>
            <a href="<?= esc($repositoryUrl) ?>" target="_blank" rel="noopener"
               class="stretched-link" aria-label="<?php echo _('Open repository'); ?>"></a>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>

<?php include 'footer.php'; ?>
