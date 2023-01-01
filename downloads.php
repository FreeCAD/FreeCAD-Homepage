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

    <div id="main" class="container-fluid">
      <div class="download-notes text-center">

      <!-- -------------------------------- -->
      <!-- Major+Minor Version of FC Stable -->
      <!-- -------------------------------- -->

      <h2 class="downloads-notes-title"><?php echo _('Current stable version: 0.20.2'); ?></h2>
      <p><?php echo _('Select your desired platform'); ?></p>

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
              <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/0.20.2/FreeCAD-0.20.2-WIN-x64-installer-1.exe">64-Bit installer</a>
            </div>
          </div>
          <div class="card-footer px-xl-5 py-xl-4">
            <small class="text-muted">
              <?php echo _('Windows 7 is the minimum supported version. For more info on installation, please check out the '); ?>
              <a href="https://wiki.freecad.org/Install_on_Windows"><?php echo _('wiki'); ?></a>.
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
            <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/0.20.2/FreeCAD_0.20.2-2022-12-27-conda-macOS-x86_64-py310.dmg">64-Bit dmg</a>
          </div>
          <div class="card-footer px-xl-5 py-xl-4">
            <small class="text-muted">
              <?php echo _('Mac OS X 10.12 Sierra is the minimum supported version. For more info on installation, please check out the '); ?>
              <a href="https://wiki.freecad.org/Install_on_Mac"><?php echo _('wiki'); ?></a>.
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
            <a class="btn btn-primary rounded-pill my-1" onclick="thankyou(event)" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/0.20.2/FreeCAD_0.20.2-2022-12-27-conda-Linux-x86_64-py310.AppImage">64-Bit AppImage</a>
          </div>
          <div class="card-footer px-xl-5 py-xl-4">
            <small class="text-muted">
              <?php echo _('For distro-specific instructions, such as Ubuntu PPA, and other ways to install on Linux, please check out the '); ?>
              <a href="https://wiki.freecad.org/Install_on_Unix"><?php echo _('wiki'); ?></a>.
            </small>
          </div>
        </div>
      </div>
    </div> <!-- class="row mx-auto download-platform" -->

    <!-- -------------------- -->
    <!-- DEVELOPMENT VERSIONS -->
    <!-- -------------------- -->

    <div class="download-notes text-center">
      <h2 class="downloads-notes-title"><?php echo _('Development versions'); ?></h2>
      <p>
        <?php echo _("FreeCAD's development happens daily!"); ?>
        <?php echo _("Therefore we generate builds that are based on <i>bleeding edge</i> FreeCAD code in order for users to test bugfixes/regressions along with new features."); ?>
        <?php echo _("We recommend more savvy users to run dev builds and help spur FreeCAD's progress."); ?>
        <?php echo _("We also recommend backing up files before working with a dev build."); ?>
        <?php echo _("The following dev builds are available for different platforms/distributions:"); ?>
        <br /><br />
        <?php echo _("Windows") ?>: <a href="https://github.com/FreeCAD/FreeCAD-AppImage/releases/tag/weekly-builds" class="badge badge-light"><?php echo _('Conda'); ?></a>
        - <?php echo _("macOS") ?>: <a href="https://github.com/FreeCAD/FreeCAD-AppImage/releases/tag/weekly-builds" class="badge badge-light"><?php echo _('Conda'); ?></a>
        / <a href="https://github.com/FreeCAD/homebrew-freecad" class="badge badge-light"><?php echo _('Homebrew'); ?></a>
        - <?php echo _("Linux") ?>: <a href="https://github.com/FreeCAD/FreeCAD-AppImage/releases/tag/weekly-builds" class="badge badge-light"><?php echo _('Conda'); ?></a>
        / <a href="https://wiki.freecad.org/Snap" class="badge badge-light"><?php echo _('Snap'); ?></a>
        / <a href="https://wiki.freecad.org/Flatpak" class="badge badge-light"><?php echo _('Flatpak'); ?></a>
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
        <a href="https://wiki.freecad.org/AddonManager" class="badge badge-light"><?php echo _('Addon manager.'); ?></a>
      </p>
    </div>


    <!-- ----------------------------- -->
    <!-- SOURCE CODE -->
    <!-- ----------------------------- -->

    <div class="download-notes text-center">
      <h2 class="downloads-notes-title"><?php echo _('Source code'); ?></h2>
      <p>
        <?php echo _('The source code of FreeCAD is hosted primarily on '); ?>
        <a href="https://github.com/FreeCAD/FreeCAD" class="badge badge-light">GitHub</a>
        <?php echo _('and mirrored on '); ?>
        <a href="https://gitlab.com/FreeCAD/FreeCAD" class="badge badge-light">GitLab</a>,
        <a href="https://codeberg.org/FreeCAD/FreeCAD" class="badge badge-light">Codeberg</a>
        <?php echo _('and '); ?>
        <a href="https://sourceforge.net/projects/free-cad/" class="badge badge-light">Sourceforge</a>
      </p>
    </div>


    </div>

<?php include 'footer.php'; ?>
