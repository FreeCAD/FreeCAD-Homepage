<?php include("translation.php"); ?>

<!DOCTYPE html>
<html lang="<?php echo $lang;?>" class="home">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width = device-width, initial-scale = 1"/>
    <meta name="description" content="FreeCAD, the open source parametric modeler"/>
  <meta name="keywords" content="freecad, engineering, open-source, opencascade, architecture, cad, bim, fem, 3d, 3d-printing, mac-osx, linux, windows, coin, parametric-modeler"/>

    <title><?php echo _('FreeCAD: Select your platform'); ?></title>
    <link rel="shortcut icon" href="images/favicon.ico"/>

    <!-- Include bootstrap CSS file -->
    <link rel="stylesheet" href="css/bootstrap-4.3.1.min.css"/>

    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-xl navbar-dark py-1 navbar-custom">
    <?php
        $indexurl = "index.php";
        $featuresurl = "features.php";
        if ($_GET["lang"] != "") {
            $indexurl = $indexurl."?lang=".$_GET["lang"];
            $featuresurl = $featuresurl."?lang=".$_GET["lang"];
        }
    ?>
    <a class="navbar-brand" href="<?php echo $indexurl; ?>">
      <img class="img-fluid" src="svg/logo-freecad.svg" alt="FreeCAD Logo"/>
    </a>

    <ul class="nav nav-pills ml-auto order-xl-last">
      <li class="nav-item dropdown">
        <a class="nav-link text-light rounded-pill dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <img src="lang/<?php echo $lang; ?>/flag.jpg"/>
        </a>

        <div class="dropdown-lang dropdown-menu dropdown-menu-right">
          <?php echo getFlags("/downloads.php"); ?>
        </div>
      </li>
    </ul>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="nav nav-pills ml-auto">
        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="<?php echo $featuresurl; ?>"><?php echo _('Features'); ?></a>
        </li>

        <li class="nav-item">
          <a class="nav-link active my-2 rounded-pill" href="#"><?php echo _('Downloads'); ?></a>
        </li>

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="https://wiki.freecad.org/Getting_started"><?php echo _('Documentation'); ?></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link my-2 rounded-pill dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Community'); ?></a>

          <div class="dropdown-community dropdown-menu dropdown-menu-right">
            <a class="dropdown-item text-dark font-weight-bold" href="https://forum.freecad.org/">Forum</a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD">GitHub</a>
            <a class="dropdown-item text-dark" href="https://gitlab.com/freecad/FreeCAD">GitLab</a>
            <a class="dropdown-item text-dark" href="https://codeberg.org/FreeCAD/FreeCAD">Codeberg</a>
            <a class="dropdown-item text-dark" href="https://fosstodon.org/@FreeCAD">Mastodon</a>
            <a class="dropdown-item text-dark" href="https://matrix.to/#/#FreeCAD_FreeCAD:gitter.im">Matrix</a>
            <a class="dropdown-item text-dark" href="irc://irc.libera.chat/freecad">IRC</a>
            <a class="dropdown-item text-dark" href="https://web.libera.chat/#freecad">IRC via Webchat</a>
            <a class="dropdown-item text-dark" href="https://gitter.im/FreeCAD/FreeCAD">Gitter.im</a>
            <a class="dropdown-item text-dark" href="https://www.reddit.com/r/freecad">Reddit</a>
            <a class="dropdown-item text-dark" href="https://twitter.com/FreeCADNews">Twitter</a>
            <a class="dropdown-item text-dark" href="https://www.facebook.com/FreeCAD">Facebook</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link my-2 rounded-pill dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Contribute'); ?></a>

          <div class="dropdown-community dropdown-menu dropdown-menu-right">
            <a class="dropdown-item text-dark" href="https://wiki.freecad.org/Help_FreeCAD"><?php echo _('How to help?'); ?></a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD/pulls"><?php echo _('Pull requests'); ?></a>
            <a class="dropdown-item text-dark" href="http://wiki.freecad.org/"><?php echo _('Wiki'); ?></a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD/issues"><?php echo _('Issues Tracker'); ?></a>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="https://wiki.freecad.org/Donate"><?php echo _('Donate'); ?></a>
        </li>

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="https://forum.freecad.org/viewforum.php?f=24"><?php echo _('Showcase'); ?></a>
        </li>
      </ul>
    </div>
  </nav>

    <div id="main" class="container-fluid">
      <div class="download-notes text-center">

      <!-- -------------------------------- -->
      <!-- Major+Minor Version of FC Stable -->
      <!-- -------------------------------- -->

      <h2 class="downloads-notes-title"><?php echo _('Current stable version: 0.19.3'); ?></h2>
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
              <a class="btn btn-primary rounded-pill my-1" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/0.19.3/FreeCAD-0.19.3-WIN-x64-installer-3.exe">64-Bit installer</a>
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
            <a class="btn btn-primary rounded-pill my-1" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/0.19.3/FreeCAD_0.19.3-OSX-x86_64-conda.dmg">64-Bit dmg</a>
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
            <a class="btn btn-primary rounded-pill my-1" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/0.19.3/FreeCAD_0.19.3-Linux-Conda_glibc2.12-x86_64.AppImage">64-Bit AppImage</a>
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
        <?php echo _("FreeCAD's development is always active! Do you want to check out the latest development 
        release? For MacOS, Windows, Linux (AppImage) and source code, see the "); ?>
        <a href="https://github.com/FreeCAD/FreeCAD-AppImage/releases/tag/weekly-builds" class="badge badge-light"><?php echo _('FreeCAD weekly builds page.'); ?></a>
      </p>
    </div>

    <!-- ----------------------------- -->
    <!-- ADDITIONAL MODULES AND MACROS -->
    <!-- ----------------------------- -->
    
    <div class="download-notes text-center">
      <h2 class="downloads-notes-title"><?php echo _('Additional modules and macros'); ?></h2>
      <p>
        <?php echo _('The FreeCAD community provides a wealth of additional modules and macros. They can 
        now easily be installed directly from within FreeCAD using the  '); ?> 
        <a href="https://wiki.freecad.org/AddonManager" class="badge badge-light"><?php echo _('Addon manager.'); ?></a>
      </p>
    </div>
    </div>

<?php include 'footer.php'; ?>
