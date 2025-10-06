<?php
    $currentpage = "downloads.php";
    include("header.php");
?>

    <script>
        function thankyou(e) {
            // redirects to the thankyou page, which takes care of the download
            dlink = e.target.href;
            durl = "thankyou.php?url=" + encodeURIComponent(dlink) + "<?php echo $langattrib; ?>";
            e.preventDefault();
            window.location = durl;
            return false;
        }
function updateLatestCategoryFromFeed(xmlUrl, titleId, bodyId, buttonId, imageId) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', xmlUrl, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var parser = new DOMParser();
      var xml = parser.parseFromString(xhr.responseText, 'application/xml');

      var latestEventsPost = xml.getElementsByTagName('item')[0];

      var sectionTitle = document.getElementById(titleId);
      var sectionBody = document.getElementById(bodyId);
      var learnMoreButton = document.getElementById(buttonId);
      var imageElement = document.getElementById(imageId);

      if (latestEventsPost) {
        sectionTitle.textContent = latestEventsPost.getElementsByTagName('title')[0].textContent;
        sectionBody.innerHTML = latestEventsPost.getElementsByTagName('description')[0].textContent;
        learnMoreButton.setAttribute('href', latestEventsPost.getElementsByTagName('link')[0].textContent);

        var contentEncoded = latestEventsPost.getElementsByTagName('content:encoded')[0]?.textContent || '';
        var tempDiv = document.createElement('div');
        tempDiv.innerHTML = contentEncoded;
        var firstImage = tempDiv.querySelector('img');
        var imageUrl = firstImage ? firstImage.src : '';

        if (!imageUrl) {
          imageUrl = 'images/Development-Updates.avif';
        }

        if (imageElement) {
          imageElement.setAttribute('src', imageUrl);
        }
      }
    }
  };
  xhr.send();
}

updateLatestCategoryFromFeed(
  'proxy-xml.php?url=https://blog.freecad.org/category/releases/feed/',
  'releases-title',
  'releases-description',
  'releases-link',
  'releases-image'
);
    </script>

    <main id="main" class="container-fluid">
      <div class="download-notes text-center">

        <!-- -------------------------------- -->
        <!-- Major+Minor Version of FC Stable -->
        <!-- -------------------------------- -->

        <h2 class="downloads-notes-title"><?php echo _('Current stable version:'); ?> 1.0.2</h2>
        <p><?php echo _('Select your desired platform (note that all downloads are for 64-bit systems):'); ?></p>

      </div>

      <!-- ------- -->
      <!-- Windows -->
      <!-- ------- -->

      <div class="row mx-auto download-platform">
        <div class="col-sm-6 col-lg-4 my-4">
          <div class="card ">
            <div class="card-body d-block align-items-center text-center px-xl-5 py-xl-4">
              <div class="w-md-100 w-50 text-center mx-auto mb-3">
                <svg version="1.1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m2.03 4.83 8.15-1.11 0.0035 7.84-8.15 0.0462zm8.15 7.65 0.0062 7.87-8.15-1.12-4.56e-4 -6.81zm0.987-8.9 10.8-1.58v9.46l-10.8 0.0856zm10.8 8.99-0.0025 9.43-10.8-1.52-0.0151-7.93z" stroke-width="1.6"/></svg>

              </div>
              <h3 class="card-title download-platform-name m-0 pb-3">Windows</h3>
              <div class="flex-column flex-lg-row">
                <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/1.0.2/FreeCAD_1.0.2-conda-Windows-x86_64-installer-1.exe">x86_64 installer</a>
                <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/1.0.2/FreeCAD_1.0.2-conda-Windows-x86_64-py311.7z">x86_64 portable (.7z)</a>
              </div>
            </div>
            <div class="card-footer px-xl-5 py-xl-4">
              <small class="text-muted">
                <?php echo _('Windows 8 is the minimum supported version. For more info on installation, please check out the '); ?>
                <a href="<?php echo _('https://wiki.freecad.org/Install_on_Windows'); ?>"><?php echo _('wiki'); ?></a>.
              </small>
            </div>
          </div>
        </div>

        <!-- ----- -->
        <!-- MacOS -->
        <!-- ----- -->

        <div class="col-sm-6 col-lg-4 my-4">
          <div class="card ">
            <div class="card-body d-block align-items-center text-center px-xl-5 py-xl-4">
              <div class="w-md-100 w-50 text-center mx-auto mb-3">
              <svg version="1.1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m20.1 17.6c-0.302 0.697-0.66 1.34-1.07 1.93-0.566 0.803-1.03 1.37-1.38 1.67-0.55 0.506-1.14 0.766-1.78 0.781-0.453 0-1-0.13-1.64-0.391-0.641-0.262-1.23-0.391-1.77-0.391-0.566 0-1.17 0.13-1.81 0.391-0.647 0.263-1.17 0.4-1.57 0.413-0.606 0.0258-1.21-0.242-1.81-0.803-0.384-0.334-0.866-0.913-1.45-1.73-0.619-0.872-1.13-1.88-1.53-3.04-0.428-1.25-0.641-2.45-0.641-3.63 0-1.33 0.289-2.48 0.866-3.44 0.453-0.775 1.06-1.39 1.81-1.84 0.756-0.45 1.58-0.678 2.45-0.694 0.481 0 1.12 0.15 1.9 0.441 0.785 0.294 1.28 0.444 1.51 0.444 0.165 0 0.722-0.174 1.67-0.522 0.894-0.322 1.65-0.456 2.27-0.403 1.67 0.135 2.94 0.797 3.78 1.99-1.5 0.91-2.24 2.18-2.23 3.81 0.0135 1.27 0.475 2.33 1.38 3.16 0.413 0.391 0.872 0.691 1.38 0.906-0.111 0.322-0.227 0.628-0.353 0.925zm-3.84-15.2c0 0.997-0.363 1.93-1.09 2.79-0.875 1.03-1.93 1.61-3.09 1.52-0.0146-0.12-0.0231-0.246-0.0231-0.378 0-0.956 0.416-1.98 1.16-2.82 0.369-0.425 0.841-0.778 1.41-1.06 0.569-0.277 1.11-0.431 1.61-0.456 0.0147 0.133 0.021 0.266 0.021 0.4z" /></svg>

              </div>

              <h3 class="card-title download-platform-name m-0 pb-3">Mac</h3>
              <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/1.0.2/FreeCAD_1.0.2-conda-macOS-arm64-py311.dmg">Apple Silicon</a>
              <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/1.0.2/FreeCAD_1.0.2-conda-macOS-x86_64-py311.dmg">Intel</a>
            </div>
            <div class="card-footer px-xl-5 py-xl-4">
              <small class="text-muted">
                <?php echo _('macOS 10.13 High Sierra is the minimum supported version. For more info on installation, please check out the '); ?>
                <a href="<?php echo _('https://wiki.freecad.org/Install_on_Mac'); ?>"><?php echo _('wiki'); ?></a>.
              </small>
            </div>
          </div>
        </div>

        <!-- -------------- -->
        <!-- Linux/AppImage -->
        <!-- -------------- -->

        <div class="col-sm-6 col-lg-4 my-4">
          <div class="card ">
            <div class="card-body d-block align-items-center text-center px-xl-5 py-xl-4">
              <img class="w-md-100 w-50" src="svg/icon-linux.svg" alt="Linux">
              <h3 class="card-title download-platform-name m-0 pb-3">Linux</h3>
              <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/1.0.2/FreeCAD_1.0.2-conda-Linux-x86_64-py311.AppImage">x86_64 AppImage</a>
              <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/1.0.2/FreeCAD_1.0.2-conda-Linux-aarch64-py311.AppImage">aarch64 AppImage</a>
            </div>
            <div class="card-footer px-xl-5 py-xl-4">
              <small class="text-muted">
                <?php echo _('For distro-specific install instructions such as Ubuntu PPA and other ways to install on Linux please check out the '); ?>
                <a href="<?php echo _('https://wiki.freecad.org/Install_on_Unix'); ?>"><?php echo _('wiki'); ?></a>.
              </small>
            </div>
          </div>
        </div>
      </div> <!-- class="row mx-auto download-platform" -->

      <!-- ------------- -->
      <!-- RELEASE NOTES -->
      <!-- ------------- -->

      <div class="download-notes text-center">
        <p>
          <?php echo _("See what has changed since last version in the"); ?>
          <a class="badge text-bg-light text-decoration-none" href="<?php echo _('https://wiki.freecad.org/Release_notes_1.0'); ?>"><?php echo _('FreeCAD 1.0 release notes'); ?></a>
        </p>
      </div>

      <!-- ------------- -->
      <!-- NEXT VERSION  -->
      <!-- ------------- -->



      <!-- -------------------- -->
      <!-- DEVELOPMENT VERSIONS -->
      <!-- -------------------- -->


      <section class="row mb-5">

      <div class="col-12 text-center mb-3 display-4">
      <h2 class="development-versions-title"><?php echo _('Development versions'); ?></h2>
      </div>

      <div class="col-12 card p-4">
<p>
          <?php echo _("FreeCAD's development happens daily!"); ?>
          <?php echo _("The FreeCAD community generates weekly builds that are based on <i>bleeding edge</i> FreeCAD code in order for users to test bugfixes/regressions along with new features."); ?>
          <?php echo _("We ask that advanced users occasionally run the development builds to assist with testing new code."); ?>
          <?php echo _("These builds are not suitable for production use, and care should be taken when using them (back up your files regularly, etc.)."); ?>
          <?php echo _("Development builds should be expected to be slower, consume more memory, and be less stable than the official release versions."); ?>
          <br/><br/>
          <?php echo _('Download here a '); ?><a href="https://github.com/FreeCAD/FreeCAD/releases" class="badge text-bg-light text-decoration-none"><?php echo _('Weekly Build'); ?></a><?php echo _(' for Windows, macOS or Linux. '); ?>
          <?php echo _("On Linux"); ?>, <a href="<?php echo _('https://wiki.freecad.org/Snap'); ?>" class="badge text-bg-light text-decoration-none"><?php echo ('Snap'); ?></a>
          <?php echo _("and"); ?> <a href="<?php echo _('https://wiki.freecad.org/Flatpak'); ?>" class="badge text-bg-light text-decoration-none"><?php echo ('Flatpak'); ?></a>
          <?php echo _("also provide development channels"); ?>.
          <br /><br />
        </p>
      </div>

      </section>


      <!-- ----------------------------- -->
      <!-- ADDITIONAL MODULES AND MACROS -->
      <!-- ----------------------------- -->

  

      <!-- ----------------------------- -->
      <!-- SOURCE CODE -->
      <!-- ----------------------------- -->

      <section class="row">

      <div class="col-md-5 ">


      <div class="card p-4 me-auto h-100">

      

        <h2 ><?php echo _('Source code'); ?></h2>
        <p>
          <?php echo _('The source code of FreeCAD is hosted primarily on '); ?>
          <a href="https://github.com/FreeCAD/FreeCAD" class="badge text-bg-light text-decoration-none">GitHub</a>
          <?php echo _('and mirrored on '); ?>
          <a href="https://gitlab.com/FreeCAD/FreeCAD" class="badge text-bg-light text-decoration-none">GitLab</a>,
          <a href="https://codeberg.org/FreeCAD/FreeCAD" class="badge text-bg-light text-decoration-none">Codeberg</a>
          <?php echo _('and '); ?>
          <a href="https://sourceforge.net/projects/free-cad/" class="badge text-bg-light text-decoration-none">Sourceforge</a>
        </p>
      </div>
</div>
      <div class="col-md-6 card p-4 ms-auto h-100">
   <h2><?php echo _('Additional modules and macros'); ?></h2>
        <p>
          <?php echo _('The FreeCAD community provides a wealth of additional modules and macros. They can
          now easily be installed directly from within FreeCAD using the '); ?>
          <a href="<?php echo _('https://wiki.freecad.org/Std_AddonMgr'); ?>" class="badge text-bg-light text-decoration-none"><?php echo _('Addon manager.'); ?></a>
        </p>
      </div>
      </section>

      <div class="download-notes text-center">
        
      </div>




        <section class="row section d-flex align-items-center justify-content-around rounded mb-5">
        
          <div class="col-lg-6 text-light text-center text-lg-start rounded text-backround pb-3">
              <h3 id="releases-title" class="section-title mt-3 placeholder-glow">
                  <span class="placeholder col-6 bg-secondary"></span>
              </h3>
              <p id="releases-description" class="section-body placeholder-glow">
                  <span class="placeholder col-12 bg-secondary"></span>
                  <span class="placeholder col-8 bg-secondary"></span>
                  <span class="placeholder col-10 bg-secondary"></span>
              </p>
              <a id="releases-link" href="#" class="btn btn-light rounded-pill mt-3">
                  <?php echo _('Learn more'); ?>
              </a>
          </div>
        </section>


    </main>


<?php include 'footer.php'; ?>
