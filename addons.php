<?php
$currentpage = "addons.php";
include("header.php");
?>

<style>
  .card{
    background-color: rgba(52, 58, 64, 0.5);
  }
  .addon-logo{
    width:64px; height:64px; border-radius:50%;
    display:grid; place-items:center;
    background:
      radial-gradient(60% 60% at 30% 30%, rgba(255,255,255,.12), transparent 60%),
      linear-gradient(135deg, #1c2530 0%, #0e1217 100%);
    border:1px solid rgba(255,255,255,.14);
    box-shadow: inset 0 2px 6px rgba(0,0,0,.35), 0 4px 12px rgba(0,0,0,.18);
  }
  .addon-logo img{ width:72%; height:72%; object-fit:contain; }
</style>

<?php
$addonsCacheUrl = 'https://www.freecad.org/addons/addon_cache.json';
$addonsMap = json_decode(file_get_contents($addonsCacheUrl), true);

$addons = [];
foreach ($addonsMap as $slug => $data){
  if (isset($data['package.xml'])){
    $xml = @simplexml_load_string($data['package.xml']);
    $pkg = $xml ? json_decode(json_encode($xml), true) : [];
    unset($data['package.xml']);
    $addons[$slug] = array_merge($data, $pkg);
  } else {
    $addons[$slug] = $data;
  }
}

function esc($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function toArray($v){ return is_array($v) ? $v : (($v!=='' && $v!==null) ? [$v] : []); }
function getValue($arr, $paths, $default=''){
  foreach((array)$paths as $path){
    $cur = $arr;
    foreach(explode('.', $path) as $k){
      if (is_array($cur) && array_key_exists($k,$cur)) $cur = $cur[$k];
      else { $cur = null; break; }
    }
    if ($cur !== null && $cur !== '') return $cur;
  }
  return $default;
}
?>

<main id="main" class="container-fluid">
  <div class="download-notes text-center">
    <h2 class="features-title"><?php echo _('Addons'); ?></h2>
  </div>
    <div class="row g-3 row-cols-1 row-cols-lg-2">
      <?php foreach ($addons as $key => $addon):
        if (!is_array($addon) || !$addon) continue;

        $name        = getValue($addon, ['name','content.workbench.name','repo','internalName'], is_string($key)?$key:'Add-on');
        $description = getValue($addon, ['description','content.workbench.description','summary'], '');
        $version     = getValue($addon, ['version','content.workbench.version'], '');
        $date        = getValue($addon, ['date','released','updated'], '');
        $license     = getValue($addon, ['license','content.workbench.license'], '');
        $maintainer  = getValue($addon, ['maintainer','author','content.workbench.maintainer'], '');

        $repositoryUrl = null;
        if (isset($addon['url']))      { $u = toArray($addon['url']);      $repositoryUrl = $repositoryUrl ?: ($u[0] ?? null); }
        if (isset($addon['repo']))     { $u = toArray($addon['repo']);     $repositoryUrl = $repositoryUrl ?: ($u[0] ?? null); }
        if (isset($addon['homepage'])) { $u = toArray($addon['homepage']); $repositoryUrl = $repositoryUrl ?: ($u[0] ?? null); }

        $iconUrlMain   = null;
        $iconUrlMaster = null;
        $iconPath = null;
        if (isset($addon['icon'])) $iconPath = $addon['icon'];
        if (!$iconPath && isset($addon['content']['workbench']['icon'])) $iconPath = $addon['content']['workbench']['icon'];
        if ($iconPath){
          if (preg_match('~^https?://~i', $iconPath)) {
            $iconUrlMain = $iconPath;
          } else {
            $repoForIcon = null;
            if (isset($addon['url']))      $repoForIcon = is_array($addon['url']) ? ($addon['url'][0] ?? null) : $addon['url'];
            if (!$repoForIcon && isset($addon['repo']))     $repoForIcon = is_array($addon['repo']) ? ($addon['repo'][0] ?? null) : $addon['repo'];
            if (!$repoForIcon && isset($addon['homepage'])) $repoForIcon = is_array($addon['homepage']) ? ($addon['homepage'][0] ?? null) : $addon['homepage'];
            if ($repoForIcon && stripos($repoForIcon,'github.com') !== false && preg_match('~github\.com/([^/]+)/([^/]+)~', $repoForIcon, $m)){
              $owner = $m[1]; $repo = $m[2]; $rel = ltrim($iconPath,'/');
              $iconUrlMain   = "https://raw.githubusercontent.com/$owner/$repo/main/$rel";
              $iconUrlMaster = "https://raw.githubusercontent.com/$owner/$repo/master/$rel";
            }
          }
        }
        $imgOnError = '';
        if ($iconUrlMain && $iconUrlMaster) {
          $imgOnError = "onerror=\"if(!this.dataset.fbk){this.dataset.fbk=1;this.src='".esc($iconUrlMaster)."';}else{this.closest('.addon-logo')?.remove();}\"";
        } elseif ($iconUrlMain) {
          $imgOnError = "onerror=\"this.closest('.addon-logo')?.remove();\"";
        }
      ?>
      <div class="col">
        <div class="card h-100 position-relative text-light">
          <div class="card-body">
            <div class="d-flex align-items-start gap-3 mb-3">
              <?php if ($iconUrlMain): ?>
                <div class="addon-logo">
                  <img src="<?= esc($iconUrlMain) ?>" alt="" loading="lazy" decoding="async" <?= $imgOnError ?>>
                </div>
              <?php endif; ?>
              <div class="min-w-0">
                <h5 class="card-title" title="<?= esc($name) ?>"><?= esc($name) ?></h5>
                <?php if ($maintainer): ?>
                  <div class="text-white-50 small"><?= esc($maintainer) ?></div>
                <?php endif; ?>
              </div>
            </div>

            <?php if ($description): ?>
              <p class="card-text mb-3"><?= esc($description) ?></p>
            <?php endif; ?>

            <div class="small mb-0">
              <?php if ($version): ?><span class="me-2"><?php echo _('Version:'); ?> <?= esc($version) ?></span><?php endif; ?>
              <?php if ($date):    ?><span class="me-2"><?php echo _('Date:'); ?> <?= esc($date) ?></span><?php endif; ?>
              <?php if ($license): ?><span class="me-2"><?php echo _('License:'); ?> <?= esc($license) ?></span><?php endif; ?>
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
