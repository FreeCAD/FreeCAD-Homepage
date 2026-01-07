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

@media (max-width: 448px){
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
      $cachePath = (string)getValue($entry, ['relative_cache_path'], '');
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
              <?php if ($repositoryUrl): ?>
                  <a class="btn btn-sm btn-outline-light"href="<?= esc($repositoryUrl) ?>"target="_blank"rel="noopener"><?php echo _('Repo Page'); ?></a>
              <?php endif; ?>
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

            <?php if ($d30 || $d90 || $da || $cachePath): ?>
              <div class="d-flex align-items-start gap-3 mt-3 mb-3">
                <div class="text-white-50 small flex-shrink-0"><?php echo _('Downloads'); ?></div>

                <div class="d-flex flex-wrap gap-2 flex-grow-1 small">
                  <?php if ($d30): ?><span class="badge rounded-pill text-bg-dark border border-secondary-subtle"><?php echo _('30 Day'); ?> <?= esc(number_format($d30)) ?></span><?php endif; ?>
                  <?php if ($d90): ?><span class="badge rounded-pill text-bg-dark border border-secondary-subtle"><?php echo _('90 Day'); ?> <?= esc(number_format($d90)) ?></span><?php endif; ?>
                  <?php if ($da):  ?><span class="badge rounded-pill text-bg-dark border border-secondary-subtle"><?php echo _('All'); ?> <?= esc(number_format($da)) ?></span><?php endif; ?>
                </div>

                <?php if ($cachePath): ?>
                  <button type="button"class="btn btn-sm btn-outline-light downloads-trigger" data-bs-toggle="modal" data-bs-target="#chartModal" data-bs-path="<?= esc($cachePath) ?>"><?php echo _('More details'); ?></button>
                <?php endif; ?>
                </div>
            <?php endif; ?>
              </div>


        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <script src="js/chart-4.4.8.js"></script>
<div class="modal fade" id="chartModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content bg-dark">
      <div class="modal-header border-secondary">
        <h1 class="modal-title fs-6 text-light" id="chartModalLabel"><?php echo _('Downloads'); ?></h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="card card-body bg-dark border-secondary text-light mb-3">
          <div class="row g-2">

            <div class="col-12 col-md-5">
              <label class="form-label mb-1 text-white-50"><?php echo _('Period'); ?></label>
              <div class="btn-group w-100" role="group">
                <input type="radio" class="btn-check" name="period" id="p_day" value="day" autocomplete="off" checked>
                <label class="btn btn-sm btn-outline-light" for="p_day"><?php echo _('Day'); ?></label>

                <input type="radio" class="btn-check" name="period" id="p_week" value="week" autocomplete="off">
                <label class="btn btn-sm btn-outline-light" for="p_week"><?php echo _('Week'); ?></label>

                <input type="radio" class="btn-check" name="period" id="p_month" value="month" autocomplete="off">
                <label class="btn btn-sm btn-outline-light" for="p_month"><?php echo _('Month'); ?></label>
              </div>
            </div>

            <div class="col-12 col-md-7">
              <label class="form-label mb-1 text-white-50"><?php echo _('Preset'); ?></label>

              <div class="btn-group w-100 flex-wrap preset-group" role="group" id="preset_day" data-period="day">
                <input type="radio" class="btn-check" name="preset_day" id="day_last7" value="last7" autocomplete="off" checked>
                <label class="btn btn-sm btn-outline-light" for="day_last7"><?php echo _('Last 7 days'); ?></label>

                <input type="radio" class="btn-check" name="preset_day" id="day_last30" value="last30" autocomplete="off">
                <label class="btn btn-sm btn-outline-light" for="day_last30"><?php echo _('Last 30 days'); ?></label>

                <input type="radio" class="btn-check" name="preset_day" id="day_last90" value="last90" autocomplete="off">
                <label class="btn btn-sm btn-outline-light" for="day_last90"><?php echo _('Last 90 days'); ?></label>

                <input type="radio" class="btn-check" name="preset_day" id="day_custom" value="custom" autocomplete="off">
                <label class="btn btn-sm btn-outline-light" for="day_custom"><?php echo _('Custom'); ?></label>
              </div>

              <div class="btn-group w-100 flex-wrap preset-group d-none" role="group" id="preset_week" data-period="week">
                <input type="radio" class="btn-check" name="preset_week" id="week_last4w" value="last4w" autocomplete="off" checked>
                <label class="btn btn-sm btn-outline-light" for="week_last4w"><?php echo _('Last 4 weeks'); ?></label>

                <input type="radio" class="btn-check" name="preset_week" id="week_last12w" value="last12w" autocomplete="off">
                <label class="btn btn-sm btn-outline-light" for="week_last12w"><?php echo _('Last 12 weeks'); ?></label>

                <input type="radio" class="btn-check" name="preset_week" id="week_last52w" value="last52w" autocomplete="off">
                <label class="btn btn-sm btn-outline-light" for="week_last52w"><?php echo _('Last 52 weeks'); ?></label>

                <input type="radio" class="btn-check" name="preset_week" id="week_custom" value="custom" autocomplete="off">
                <label class="btn btn-sm btn-outline-light" for="week_custom"><?php echo _('Custom'); ?></label>
              </div>

              <div class="btn-group w-100 flex-wrap preset-group d-none" role="group" id="preset_month" data-period="month">
                <input type="radio" class="btn-check" name="preset_month" id="month_last3m" value="last3m" autocomplete="off" checked>
                <label class="btn btn-sm btn-outline-light" for="month_last3m"><?php echo _('Last 3 months'); ?></label>

                <input type="radio" class="btn-check" name="preset_month" id="month_last6m" value="last6m" autocomplete="off">
                <label class="btn btn-sm btn-outline-light" for="month_last6m"><?php echo _('Last 6 months'); ?></label>

                <input type="radio" class="btn-check" name="preset_month" id="month_last12m" value="last12m" autocomplete="off">
                <label class="btn btn-sm btn-outline-light" for="month_last12m"><?php echo _('Last 12 months'); ?></label>

                <input type="radio" class="btn-check" name="preset_month" id="month_custom" value="custom" autocomplete="off">
                <label class="btn btn-sm btn-outline-light" for="month_custom"><?php echo _('Custom'); ?></label>
              </div>
            </div>

            <div class="col-12 col-md-4  d-none">
              <label class="form-label mb-1 text-white-50"><?php echo _('All'); ?><?php echo _('Metric'); ?></label>
              <div class="btn-group w-100" role="group">
                <input type="radio" class="btn-check" name="metric" id="m_hits" value="nb_hits" autocomplete="off" checked>
                <label class="btn btn-sm btn-outline-light" for="m_hits"><?php echo _('Downloads'); ?></label>

                <input type="radio" class="btn-check" name="metric" id="m_visits" value="nb_visits" autocomplete="off">

                <label class="btn btn-sm btn-outline-light" for="m_visits"><?php echo _('Unique downloads'); ?></label>
              </div>
            </div>

            <div class="col-12" id="customDates" style="display:none;">
              <div class="row g-2">
                <div class="col-12 col-md-6">
                  <label class="form-label mb-1 text-white-50"><?php echo _('Start Date'); ?></label>
                  <input type="date" class="form-control bg-dark text-light border-secondary" id="start">
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label mb-1 text-white-50"><?php echo _('End Date'); ?></label>
                  <input type="date" class="form-control bg-dark text-light border-secondary" id="end">
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="card card-body bg-dark border-secondary">
          <canvas id="chart" height="260"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

  var apiUrl = 'matomo-addon-downloads.php';

  var chartModal = document.getElementById('chartModal');
  var chartModalLabel = document.getElementById('chartModalLabel');

  var customDates = document.getElementById('customDates');
  var startInput = document.getElementById('start');
  var endInput = document.getElementById('end');

  var presetDay = document.getElementById('preset_day');
  var presetWeek = document.getElementById('preset_week');
  var presetMonth = document.getElementById('preset_month');

  var currentPath = './CatalogCache/sheetmetal/0-master.zip';
  var currentLabel = '';

  Chart.defaults.color = '#e9ecef';
  Chart.defaults.borderColor = '#fff';

  function getCheckedValue(name) {
    var x = document.querySelector('input[name="' + name + '"]:checked');
    return x ? x.value : '';
  }

  function fmt(d) {
    var y = d.getFullYear();
    var m = String(d.getMonth() + 1).padStart(2, '0');
    var da = String(d.getDate()).padStart(2, '0');
    return y + '-' + m + '-' + da;
  }

  function matomoLabelFromPath(path) {
    path = String(path || '').replace(/^\.\//, '');
    return 'addons.freecad.org &gt; @%2F' + path.split('/').join('%2F');
  }

  function parseYMD(s) {
    var m = String(s || '').match(/^(\d{4})-(\d{2})-(\d{2})$/);
    if (!m) return null;
    return new Date(Date.UTC(+m[1], +m[2] - 1, +m[3]));
  }

  function isoWeekInfo(dateUtc) {
    var d = new Date(dateUtc.getTime());
    var day = d.getUTCDay() || 7;
    d.setUTCDate(d.getUTCDate() + 4 - day);
    var year = d.getUTCFullYear();
    var yearStart = new Date(Date.UTC(year, 0, 1));
    var week = Math.ceil((((d - yearStart) / 86400000) + 1) / 7);
    return { year: year, week: week };
  }

  function weekFromRangeLabel(label) {
    var parts = String(label || '').split(',');
    if (parts.length !== 2) return null;

    var a = parseYMD(parts[0].trim());
    var b = parseYMD(parts[1].trim());
    if (!a || !b) return null;

    var wi = isoWeekInfo(a);

    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var ya = a.getUTCFullYear(), yb = b.getUTCFullYear();
    var ma = a.getUTCMonth(), mb = b.getUTCMonth();
    var d1 = a.getUTCDate(), d2 = b.getUTCDate();

    var rangeText = '';
    if (ya === yb && ma === mb) rangeText = months[ma] + ' ' + d1 + '–' + d2;
    else if (ya === yb) rangeText = months[ma] + ' ' + d1 + '–' + months[mb] + ' ' + d2;
    else rangeText = months[ma] + ' ' + d1 + ' ' + ya + '–' + months[mb] + ' ' + d2 + ' ' + yb;

    return { year: wi.year, week: wi.week, rangeText: rangeText };
  }

  function presetInputs(period) {
    return Array.prototype.slice.call(document.querySelectorAll('#preset_' + period + ' input[type="radio"]'));
  }

  function presetIndex(period) {
    var inputs = presetInputs(period);
    for (var i = 0; i < inputs.length; i++) if (inputs[i].checked) return i;
    return 0;
  }

  function setPresetIndex(period, idx) {
    var inputs = presetInputs(period);
    if (!inputs.length) return;
    if (idx < 0) idx = 0;
    if (idx > inputs.length - 1) idx = inputs.length - 1;
    inputs[idx].checked = true;
  }

  function showPresetGroup(period) {
    presetDay.classList.add('d-none');
    presetWeek.classList.add('d-none');
    presetMonth.classList.add('d-none');
    if (period === 'week') presetWeek.classList.remove('d-none');
    else if (period === 'month') presetMonth.classList.remove('d-none');
    else presetDay.classList.remove('d-none');
  }

  function activePreset(period) {
    var x = document.querySelector('input[name="preset_' + period + '"]:checked');
    return x ? x.value : '';
  }

  function calcRange(preset) {
    var end = new Date();
    end.setHours(0, 0, 0, 0);
    var start = new Date(end);

    if (preset === 'last7') start.setDate(start.getDate() - 6);
    else if (preset === 'last30') start.setDate(start.getDate() - 29);
    else if (preset === 'last90') start.setDate(start.getDate() - 89);
    else if (preset === 'last4w') start.setDate(start.getDate() - (7 * 4 - 1));
    else if (preset === 'last12w') start.setDate(start.getDate() - (7 * 12 - 1));
    else if (preset === 'last52w') start.setDate(start.getDate() - (7 * 52 - 1));
    else if (preset === 'last3m') { start.setMonth(start.getMonth() - 3); start.setDate(start.getDate() + 1); }
    else if (preset === 'last6m') { start.setMonth(start.getMonth() - 6); start.setDate(start.getDate() + 1); }
    else if (preset === 'last12m') { start.setMonth(start.getMonth() - 12); start.setDate(start.getDate() + 1); }

    return { start: fmt(start), end: fmt(end) };
  }

  function applyPreset() {
    var period = getCheckedValue('period') || 'day';
    var preset = activePreset(period);

    if (preset === 'custom') {
      customDates.style.display = 'block';
      if (!startInput.value) startInput.value = fmt(new Date(new Date().setDate(new Date().getDate() - 29)));
      if (!endInput.value) endInput.value = fmt(new Date());
    } else {
      customDates.style.display = 'none';
      var r = calcRange(preset);
      startInput.value = r.start;
      endInput.value = r.end;
    }
  }

  function setLabel(path) {
    currentPath = path || currentPath;
    currentLabel = matomoLabelFromPath(currentPath);
    chartModalLabel.textContent = currentPath;
  }

  var chart = new Chart(document.getElementById('chart'), {
    type: 'line',
    data: { labels: [], datasets: [{ label: 'Downloads', data: [], pointRadius: 1, borderWidth: 2, tension: 0.25 }] },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      interaction: { mode: 'index', intersect: false },
      scales: {
        y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.12)' } },
        x: {
          grid: { color: 'rgba(255,255,255,0.12)' },
          ticks: {
            callback: function (v, i) {
              var p = getCheckedValue('period') || 'day';
              var lbl = String(chart.data.labels[i] || '');
              if (p !== 'week') return lbl;
              var w = weekFromRangeLabel(lbl);
              return w ? (w.year + '-W' + String(w.week).padStart(2, '0')) : lbl;
            }
          }
        }
      },
      plugins: {
        tooltip: {
          callbacks: {
            title: function (items) {
              if (!items || !items.length) return '';
              var p = getCheckedValue('period') || 'day';
              var lbl = String(items[0].label || '');
              if (p !== 'week') return lbl;
              var w = weekFromRangeLabel(lbl);
              return w ? (w.year + '-W' + String(w.week).padStart(2, '0') + ' (' + w.rangeText + ')') : lbl;
            }
          }
        }
      }
    }
  });

  function load() {
    var p = getCheckedValue('period') || 'day';
    var m = getCheckedValue('metric') || 'nb_hits';

    var qs = new URLSearchParams();
    qs.set('label', currentLabel);
    qs.set('period', p);
    qs.set('metric', m);
    qs.set('start', startInput.value);
    qs.set('end', endInput.value);

fetch(apiUrl + '?' + qs.toString(), { cache: 'no-store' })
  .then(function (r) { return r.json(); })
  .then(function (arr) {
    if (!Array.isArray(arr)) {
      chart.data.labels = [];
      chart.data.datasets[0].data = [];
      chart.update();
      return;
    }
    chart.data.labels = arr.map(function (x) { return x.label; });
    chart.data.datasets[0].data = arr.map(function (x) { return x.value; });
    chart.update();
  });
  }

  var lastPeriod = getCheckedValue('period') || 'day';

  document.querySelectorAll('input[name="period"]').forEach(function (el) {
    el.addEventListener('change', function () {
      var idx = presetIndex(lastPeriod);

      lastPeriod = getCheckedValue('period') || 'day';
      showPresetGroup(lastPeriod);
      setPresetIndex(lastPeriod, idx);

      applyPreset();
      load();
    });
  });

  document.querySelectorAll('.preset-group').forEach(function (el) {
    el.addEventListener('change', function () {
      applyPreset();
      load();
    });
  });

  document.querySelectorAll('input[name="metric"]').forEach(function (el) {
    el.addEventListener('change', function () {
      load();
    });
  });

  startInput.addEventListener('change', function () {
    var p = getCheckedValue('period') || 'day';
    if (activePreset(p) === 'custom') load();
  });

  endInput.addEventListener('change', function () {
    var p = getCheckedValue('period') || 'day';
    if (activePreset(p) === 'custom') load();
  });

  chartModal.addEventListener('show.bs.modal', function (event) {
    var btn = event.relatedTarget;
    var path = btn ? btn.getAttribute('data-bs-path') : '';
    if (path) setLabel(path);

    lastPeriod = getCheckedValue('period') || 'day';
    showPresetGroup(lastPeriod);
    applyPreset();
  });

  chartModal.addEventListener('shown.bs.modal', function () {
    setTimeout(function () {
      chart.resize();
      load();
    }, 50);
  });

  setLabel(currentPath);
  showPresetGroup(lastPeriod);
  applyPreset();

});
</script>
</main>

<?php include 'footer.php'; ?>
