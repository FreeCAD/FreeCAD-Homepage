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
    <a class="navbar-brand" href="index.php">
      <img class="img-fluid" src="svg/logo-freecad.svg" alt="FreeCAD Logo"/>
    </a>

    <ul class="nav nav-pills ml-auto order-xl-last">
      <li class="nav-item dropdown">
        <a class="nav-link text-light rounded-pill dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <img src="lang/<?php echo $lang; ?>/flag.jpg"/>
        </a>

        <div class="dropdown-lang dropdown-menu dropdown-menu-right">
          <?php echo getFlags("/"); ?>
        </div>
      </li>
    </ul>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="nav nav-pills ml-auto">
        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="https://www.freecadweb.org/wiki/Feature_list"><?php echo _('Features'); ?></a>
        </li>

        <li class="nav-item">
          <a class="nav-link active my-2 rounded-pill" href="downloads.php"><?php echo _('Downloads'); ?></a>
        </li>

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="https://www.freecadweb.org/wiki/Getting_started"><?php echo _('Documentation'); ?></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link my-2 rounded-pill dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Community'); ?></a>

          <div class="dropdown-community dropdown-menu dropdown-menu-right">
            <a class="dropdown-item text-dark font-weight-bold" href="https://forum.freecadweb.org/">Forum</a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD">GitHub</a>
            <a class="dropdown-item text-dark" href="https://fosstodon.org/@FreeCAD">Mastodon</a>
            <a class="dropdown-item text-dark" href="https://riot.im/app/#/room/#gitter_FreeCAD=2FFreeCAD:matrix.org">Matrix</a>
            <a class="dropdown-item text-dark" href="irc://chat.freenode.net/freecad">IRC</a>
            <a class="dropdown-item text-dark" href="https://gitter.im/FreeCAD/FreeCAD">Gitter.im</a>
            <a class="dropdown-item text-dark" href="https://www.reddit.com/r/freecad">Reddit</a>
            <a class="dropdown-item text-dark" href="https://twitter.com/FreeCADNews">Twitter</a>
            <a class="dropdown-item text-dark" href="https://www.facebook.com/FreeCAD">Facebook</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link my-2 rounded-pill dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Contribute'); ?></a>

          <div class="dropdown-community dropdown-menu dropdown-menu-right">
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD">GitHub</a>
            <a class="dropdown-item text-dark" href="http://www.freecadweb.org/wiki/">Wiki</a>
            <a class="dropdown-item text-dark" href="http://www.freecadweb.org/tracker/">Bug Tracker</a>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="https://www.freecadweb.org/wiki/Donate"><?php echo _('Donate'); ?></a>
        </li>

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="https://forum.freecadweb.org/viewforum.php?f=24"><?php echo _('Showcase'); ?></a>
        </li>
      </ul>
    </div>
  </nav>

	<div id="main" class="container-fluid">
		<div class="download-notes text-center">

      <!-- Major+Minor Version of FC Stable -->
			<h2 class="downloads-notes-title"><?php echo _('Current stable version: 0.18.3'); ?></h2>
			<p><?php echo _('Select your desired platform'); ?></p>

    </div>

    <!-- Windows -->

    <div class="row mx-auto download-platform">
      <div class="col-sm-6 col-lg-4 my-4">
        <div class="card text-dark">
          <div class="card-body d-block align-items-center text-center px-xl-5 py-xl-4">
            <img class="w-100 p-4" src="svg/icon-windows.svg" alt="Windows">
            <h3 class="card-title download-platform-name m-0 pb-3">Windows</h3>
            <div class="flex-column flex-lg-row">
              <!-- <a class="btn btn-primary rounded-pill my-1" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/0.18.1/FreeCAD-0.18.16110.f7dccfa-WIN-x32-installer.exe">32-Bit</a> -->
              <a class="btn btn-primary rounded-pill my-1" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/0.18.3/FreeCAD-0.18.16131.3129ae4-WIN-x64-installer.exe">64-Bit</a>
            </div>
          </div>
          <div class="card-footer px-xl-5 py-xl-4">
            <small class="text-muted">
              <?php echo _('Windows 7 is the minimum supported version. For more info on installation, please check out the '); ?>
              <a href="https://www.freecadweb.org/wiki/Install_on_Windows"><?php echo _('wiki'); ?></a>.
            </small>
          </div>
        </div>
      </div>

      <!-- MacOS -->

      <div class="col-sm-6 col-lg-4 my-4">
        <div class="card text-dark">
          <div class="card-body d-block align-items-center text-center px-xl-5 py-xl-4">
            <img class="w-100 p-4" src="svg/icon-apple.svg" alt="Mac">
            <h3 class="card-title download-platform-name m-0 pb-3">Mac</h3>
            <a class="btn btn-primary rounded-pill my-1" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/0.18.3/FreeCAD_0.18-16131-OSX-x86_64-conda-Qt5-Py3.dmg">64-Bit</a>
          </div>
          <div class="card-footer px-xl-5 py-xl-4">
            <small class="text-muted">
              <?php echo _('Mac OS X 10.11 El Capitan is the minimum supported version. For more info on installation, please check out the '); ?>
              <a href="https://www.freecadweb.org/wiki/Install_on_Mac"><?php echo _('wiki'); ?></a>.
            </small>
          </div>
        </div>
      </div>

    <!-- Linux/AppImage -->

      <div class="col-sm-6 col-lg-4 my-4">
        <div class="card text-dark">
          <div class="card-body d-block align-items-center text-center px-xl-5 py-xl-4">
            <img class="w-100 p-4" src="svg/icon-linux.svg" alt="Linux">
            <h3 class="card-title download-platform-name m-0 pb-3">Linux</h3>
            <a class="btn btn-primary rounded-pill my-1" role="button" href="https://github.com/FreeCAD/FreeCAD/releases/download/0.18.3/FreeCAD_0.18-16131-Linux-Conda_Py3Qt5_glibc2.12-x86_64.AppImage">64-Bit AppImage</a>
          </div>
          <div class="card-footer px-xl-5 py-xl-4">
            <small class="text-muted">
              <?php echo _('For distro-specific instructions, such as Ubuntu PPA, and other ways to install on Linux, please check out the '); ?>
              <a href="https://www.freecadweb.org/wiki/Install_on_Unix"><?php echo _('wiki'); ?></a>.
            </small>
          </div>
        </div>
      </div>
    </div>
    
    <div class="download-notes text-center">
      <h2 class="downloads-notes-title"><?php echo _('Development versions'); ?></h2>
      <p>
        <?php echo _("FreeCAD's development is always active! Do you want to check out the latest development 
        release? For MacOS, Windows, Linux (AppImage) and source code, see the "); ?>
        <a href="https://github.com/FreeCAD/FreeCAD/releases" class="badge badge-light"><?php echo _('FreeCAD releases page.'); ?></a>
      </p>
    </div>

    <div class="download-notes text-center">
      <h2 class="downloads-notes-title"><?php echo _('Additional modules and macros'); ?></h2>
      <p>
        <?php echo _('The FreeCAD community provides a wealth of additional modules and macros. They can 
        now easily be installed directly from within FreeCAD using the  '); ?> 
        <a href="https://www.freecadweb.org/wiki/AddonManager" class="badge badge-light"><?php echo _('Addon manager.'); ?></a>
      </p>
    </div>
	</div>

	<footer class="container-fluid footer-custom bg-dark text-center text-light">
    <div class="row">
      <div class="col-md-4 col-sm-6 mb-3">
        <h4><?php echo _('Learn'); ?></h4>
        <ul class="list-unstyled">
          <li><a class="text-light" href="https://www.freecadweb.org/wiki/Tutorials"><?php echo _('Tutorials'); ?></a></li>
          <li><a class="text-light" href="https://www.youtube.com/results?search_query=freecad"><?php echo _('Youtube videos'); ?></a></li>
          <li><a class="text-light" href="https://stackexchange.com/search?q=freecad">Stack Exchange</a></li>
        </ul>
      </div>

      <div class="col-md-4 col-sm-6 mb-3">
        <h4><?php echo _('Contribute'); ?></h4>
        <ul class="list-unstyled">
          <li><a class="text-light" href="https://www.freecadweb.org/wiki/Help_FreeCAD"><?php echo _('How can I help?'); ?></a></li>
          <li><a class="text-light" href="https://www.freecadweb.org/wiki/Donate"><?php echo _('Donate'); ?></a></li>
          <li><a class="text-light" href="https://crowdin.com/project/freecad"><?php echo _('Translate'); ?></a></li>
        </ul>
      </div>

      <div class="col-md-4 col-sm-6 mb-3">
        <h4><?php echo _('Code'); ?></h4>
        <ul class="list-unstyled">
          <li><a class="text-light" href="https://www.freecadweb.org/wiki/Compiling"><?php echo _('Building from source'); ?></a></li>
          <li><a class="text-light" href="https://www.freecadweb.org/api/"><?php echo _('C++ & Python API'); ?></a></li>
          <li><a class="text-light" href="https://www.freecadweb.org/wiki/Licence"><?php echo _('License information'); ?></a></li>
        </ul>
      </div>
    </div>

    <div class="justify-content-center my-3 my-md-5">
      <a href="https://forum.freecadweb.org/"><img class="icon-social m-2" src="svg/icon-forum-light.svg" alt="Forum"/></a>
      <a href="https://github.com/FreeCAD/FreeCAD"><img class="icon-social m-2" src="svg/icon-github-light.svg" alt="GitHub"/></a>
      <a href="https://fosstodon.org/@FreeCAD"><img class="icon-social m-2" src="svg/icon-mastodon-light.svg" alt="Mastodon"/></a>
      <a href="https://riot.im/app/#/room/#gitter_FreeCAD=2FFreeCAD:matrix.org"><img class="icon-social m-2" src="svg/icon-matrix-light.svg" alt="Matrix"/></a>
      <a href="irc://chat.freenode.net/freecad"><img class="icon-social m-2" src="svg/icon-irc-light.svg" alt="IRC" /></a>
      <a href="https://gitter.im/FreeCAD/FreeCAD"><img class="icon-social m-2" src="svg/icon-gitter-light.svg" alt="Gitter.im"/></a>
      <a href="https://www.reddit.com/r/freecad"><img class="icon-social m-2" src="svg/icon-reddit-light.svg" alt="Reddit"/></a>
      <a href="https://twitter.com/FreeCADNews"><img class="icon-social m-2" src="svg/icon-twitter-light.svg" alt="Twitter"/></a>
      <a href="https://www.facebook.com/FreeCAD"><img class="icon-social m-2" src="svg/icon-facebook-light.svg" alt="Facebook"/></a>
    </div>

    <p class="footer-credits mt-3">
      <?php echo _('© The FreeCAD Team. Homepage image credits (top to bottom): ppemawm,
      r-frank, epileftric, regis, rider_mortagnais, bejant.'); ?>
    </p>
  </footer>

  <!-- Include Bootstrap JS files -->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper-1.14.7.min.js"></script>
  <script src="js/bootstrap-4.3.1.min.js"></script>
</body>
</html>