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
    </script>

    <main id="main" class="container-fluid">
      <div class="download-notes text-center">

        <!-- -------------------------------- -->
        <!-- Major+Minor Version of FC Stable -->
        <!-- -------------------------------- -->

        <h2 class="downloads-notes-title"><?php echo _('Current stable version:'); ?> 1.0.0</h2>
        <p><?php echo _('Select your desired platform (note that all downloads are for 64-bit systems):'); ?></p>

      </div>

      <!-- ------- -->
      <!-- Windows -->
      <!-- ------- -->

      <div class="row mx-auto download-platform">
        <div class="col-sm-6 col-lg-4 my-4">
          <div class="card text-dark">
            <div class="card-body d-block align-items-center text-center px-xl-5 py-xl-4">
              <img class="w-100 p-4" src="svg/icon-windows.svg" alt="Windows">
              <h3 class="card-title download-platform-name m-0 pb-3">Windows</h3>
              <div class="flex-column flex-lg-row">
                <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/1.0.0/FreeCAD_1.0.0-conda-Windows-x86_64-installer-1.exe">x86_64 installer</a>
                <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/1.0.0/FreeCAD_1.0.0-conda-Windows-x86_64-py311.7z">x86_64 portable (.7z)</a>
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
          <div class="card text-dark">
            <div class="card-body d-block align-items-center text-center px-xl-5 py-xl-4">
              <img class="w-100 p-4" src="svg/icon-apple.svg" alt="Mac">
              <h3 class="card-title download-platform-name m-0 pb-3">Mac</h3>
              <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/1.0.0/FreeCAD_1.0.0-conda-macOS-arm64-py311.dmg">Apple Silicon</a>
              <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/1.0.0/FreeCAD_1.0.0-conda-macOS-x86_64-py311.dmg">Intel</a>
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
          <div class="card text-dark">
            <div class="card-body d-block align-items-center text-center px-xl-5 py-xl-4">
              <img class="w-100 p-4" src="svg/icon-linux.svg" alt="Linux">
              <h3 class="card-title download-platform-name m-0 pb-3">Linux</h3>
              <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/1.0.0/FreeCAD_1.0.0-conda-Linux-x86_64-py311.AppImage">x86_64 AppImage</a>
              <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/1.0.0/FreeCAD_1.0.0-conda-Linux-aarch64-py311.AppImage">aarch64 AppImage</a>
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

      <div class="download-notes text-center">
        <h2 class="downloads-notes-title"><?php echo _('Development versions'); ?></h2>
        <p>
          <?php echo _("FreeCAD's development happens daily!"); ?>
          <?php echo _("The FreeCAD community generates weekly builds that are based on <i>bleeding edge</i> FreeCAD code in order for users to test bugfixes/regressions along with new features."); ?>
          <?php echo _("We ask that advanced users occasionally run the development builds to assist with testing new code."); ?>
          <?php echo _("These builds are not suitable for production use, and care should be taken when using them (back up your files regularly, etc.)."); ?>
          <?php echo _("Development builds should be expected to be slower, consume more memory, and be less stable than the official release versions."); ?>
          <br/><br/>
          <?php echo _('Download here a '); ?><a href="https://github.com/FreeCAD/FreeCAD-AppImage/releases/tag/weekly-builds" class="badge text-bg-light text-decoration-none"><?php echo _('Weekly Build'); ?></a><?php echo _(' for Windows, macOS or Linux. '); ?>
          <?php echo _("On Linux"); ?>, <a href="<?php echo _('https://wiki.freecad.org/Snap'); ?>" class="badge text-bg-light text-decoration-none"><?php echo ('Snap'); ?></a>
          <?php echo _("and"); ?> <a href="<?php echo _('https://wiki.freecad.org/Flatpak'); ?>" class="badge text-bg-light text-decoration-none"><?php echo ('Flatpak'); ?></a>
          <?php echo _("also provide developement channels"); ?>.
          <br /><br />
        </p>
      </div>

      <!-- ----------------------------- -->
      <!-- ADDITIONAL MODULES AND MACROS -->
      <!-- ----------------------------- -->

      <div class="download-notes text-center">
        <h2 class="downloads-notes-title"><?php echo _('Additional modules and macros'); ?></h2>
        <p>
          <?php echo _('The FreeCAD community provides a wealth of additional modules and macros. They can
          now easily be installed directly from within FreeCAD using the '); ?>
          <a href="<?php echo _('https://wiki.freecad.org/Std_AddonMgr'); ?>" class="badge text-bg-light text-decoration-none"><?php echo _('Addon manager.'); ?></a>
        </p>
      </div>


      <!-- ----------------------------- -->
      <!-- SOURCE CODE -->
      <!-- ----------------------------- -->

      <div class="download-notes text-center">
        <h2 class="downloads-notes-title"><?php echo _('Source code'); ?></h2>
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

    </main>

<?php include 'footer.php'; ?>
