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

$sortedAddonsMap = [];

foreach ($addonsMap as $addonKey => $entries) {
  if (!is_array($entries) || empty($entries)) continue;
  $entry = $entries[0];

  $pkgDate = '';
  if (isset($entry['metadata']['package_xml']) && $entry['metadata']['package_xml']) {
    $xml = @simplexml_load_string($entry['metadata']['package_xml']);
    if ($xml && isset($xml->date)) $pkgDate = (string)$xml->date;
  }

  $rawDate = $pkgDate ?: ($entry['last_update_time'] ?? '');
  $ts = 0;

  if ($rawDate !== '') {
    $raw  = trim((string)$rawDate);
    $norm = preg_replace('~[./]~', '-', $raw);
    $try  = strtotime($norm);

    if ($try) {
      $ts = $try;
    } else {
      if (preg_match('~^(\d{4})-(\d{1,2}|mm)-(\d{1,2}|dd)$~i', $norm, $m)) {
        $y  = (int)$m[1];
        $m2 = strtolower($m[2]) === 'mm' ? 1 : (int)$m[2];
        $d2 = strtolower($m[3]) === 'dd' ? 1 : (int)$m[3];

        if ($m2 > 12 && $d2 >= 1 && $d2 <= 12) { $tmp = $m2; $m2 = $d2; $d2 = $tmp; }
        if ($m2 < 1 || $m2 > 12) $m2 = 1;
        if ($d2 < 1 || $d2 > 31) $d2 = 1;

        $ts = strtotime(sprintf('%04d-%02d-%02d', $y, $m2, $d2)) ?: 0;

      } elseif (preg_match('~^(\d{4})$~', $norm, $m)) {
        $ts = strtotime($m[1] . '-01-01') ?: 0;

      } elseif (preg_match('~^(\d{4})-(\d{1,2})$~', $norm, $m)) {
        $y  = (int)$m[1];
        $mo = (int)$m[2];
        if ($mo < 1 || $mo > 12) $mo = 1;
        $ts = strtotime(sprintf('%04d-%02d-01', $y, $mo)) ?: 0;

      } else {
        if (preg_match('~^(\d{4})-(\d{1,2})-(\d{1,2})$~', $norm, $m)) {
          $y = (int)$m[1];
          $b = (int)$m[2];
          $c = (int)$m[3];
          if ($b > 12 && $c >= 1 && $c <= 12) {
            $ts = strtotime(sprintf('%04d-%02d-%02d', $y, $c, $b)) ?: 0;
          } else {
            $ts = strtotime(sprintf('%04d-%02d-%02d', $y, max(1, min(12, $b)), max(1, min(31, $c)))) ?: 0;
          }
        }
      }
    }
  }

  if (!$ts) {
    $fallback = strtotime((string)($entry['last_update_time'] ?? ''));
    if ($fallback) $ts = $fallback;
  }

  $sortedAddonsMap[] = [
    'key'      => $addonKey,
    'entries'  => $entries,
    'ts'       => $ts,
    'date_raw' => $rawDate
  ];
}

usort($sortedAddonsMap, function($a, $b){
  if ($a['ts'] === $b['ts']) return strcmp((string)$b['date_raw'], (string)$a['date_raw']);
  return $b['ts'] <=> $a['ts'];
});
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

      $name         = getValue($xmlArr, ['name'], (string)$addonKey);
      $description  = getValue($xmlArr, ['description'], '');
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
                if ($date) {
                  $raw  = trim((string)$date);
                  $norm = preg_replace('~[./]~','-', $raw);
                  $norm = preg_split('/[T\s]/', $norm)[0];

                  $hasMM = stripos($norm, 'mm') !== false;
                  $hasDD = stripos($norm, 'dd') !== false;

                  if ($hasMM || $hasDD) {
                    if (preg_match('~^(\d{4})-(\d{1,2})~', $norm, $m) && !$hasMM) {
                      $y  = (int)$m[1];
                      $mo = (int)$m[2];
                      if ($mo >= 1 && $mo <= 12) {
                        $displayDate = sprintf('%04d-%02d', $y, $mo);
                      } else {
                        $displayDate = sprintf('%04d', $y);
                      }
                    } elseif (preg_match('~^(\d{4})~', $norm, $m)) {
                      $displayDate = sprintf('%04d', (int)$m[1]);
                    }
                  } else {
                    if (preg_match('~^(\d{4})-(\d{1,2})-(\d{1,2})$~', $norm, $m)) {
                      $y  = (int)$m[1];
                      $mo = (int)$m[2];
                      $dy = (int)$m[3];
                      if ($mo > 12 && $dy >= 1 && $dy <= 12) { $tmp = $mo; $mo = $dy; $dy = $tmp; }
                      if ($mo < 1 || $mo > 12) $mo = 1;
                      if ($dy < 1 || $dy > 31) $dy = 1;
                      $displayDate = sprintf('%04d-%02d-%02d', $y, $mo, $dy);
                    } elseif (preg_match('~^(\d{4})-(\d{1,2})$~', $norm, $m)) {
                      $y  = (int)$m[1];
                      $mo = (int)$m[2];
                      if ($mo < 1 || $mo > 12) $mo = 1;
                      $displayDate = sprintf('%04d-%02d', $y, $mo);
                    } elseif (preg_match('~^(\d{4})$~', $norm, $m)) {
                      $displayDate = sprintf('%04d', (int)$m[1]);
                    } else {
                      $ts = strtotime($norm);
                      if ($ts) $displayDate = date('Y-m-d', $ts);
                    }
                  }
                }
              ?>

              <?php if ($displayDate): ?>
                <span class="me-2"><?php echo _('Date:'); ?> <?= esc($displayDate) ?></span>
              <?php endif; ?>

              <?php if ($license): ?>
                <span class="me-2"><?php echo _('License:'); ?> <?= esc(is_array($license) ? ($license[0] ?? '') : $license) ?></span>
              <?php endif; ?>
            </div>
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
