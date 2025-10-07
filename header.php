<?php
    include("translation.php");
    $homeurl = "index.php".$langStr;
    $downloadurl = "downloads.php".$langStr;
    $featuresurl = "features.php".$langStr;
    $eventsurl = "events.php".$langStr;
    $sponsorurl = "sponsor.php".$langStr;
    $codeofconducturl = "codeofconduct.php".$langStr;
    $contributingurl = "contributing.php".$langStr;
    $privacyurl = "privacy.php".$langStr;
    $blogurl = "blog.php".$langStr;
    $professionalnetworkurl = "professional-network.php".$langStr;
?>

<!DOCTYPE html>
<html lang="<?php echo $lang;?>" class="home">
<head>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width = device-width, initial-scale = 1"/>
  <meta name="description" content="FreeCAD, the open source 3D parametric modeler"/>
  <meta name="keywords" content="freecad, engineering, open-source, opencascade, architecture, cad, bim, fem, 3d, 3d-printing, mac-osx, linux, windows, coin, parametric-modeler"/>

  <title><?php echo _('FreeCAD: Your own 3D parametric modeler'); ?></title>
  <link rel="shortcut icon" href="images/favicon.ico"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <!-- Include bootstrap CSS file -->
   <link rel="stylesheet" href="css/bootstrap-5.3.3.min.css"/>

  <!-- Custom Styles -->
  <link rel="stylesheet" type="text/css" href="css/freecad-colors.css"/>
  <link rel="stylesheet" type="text/css" href="css/style.css"/>

  <!-- Social networks -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@FreeCADNews" />
  <meta name="twitter:creator" content="@FreeCADNews" />
  <meta property="og:title" content="<?php echo _('FreeCAD: Your own 3D parametric modeler'); ?>" />
  <meta property="og:description" content="FreeCAD, the open source 3D parametric modeler" />
  <meta property="og:image" content="https://freecad.org/images/banner.jpg" />

</head>

<?php
  $bodyClasses = [];
  if ($currentpage == 'professional-network.php') {
    $bodyClasses[] = 'professional-network';
  }
  if ($currentpage == 'index.php') {
    $bodyClasses[] = 'page-home';
  }
  $bodyClassString = implode(' ', $bodyClasses);

  // Navbar color class: dark for home page, light for others
  $navbarColorClass = ($currentpage == 'index.php') ? 'navbar-dark' : 'navbar-light';
  $langLinkColorClass = ($currentpage == 'index.php') ? 'text-light' : 'text-dark';
?>
<?php if ($currentpage == "thankyou.php") { ?>
<body onload="startDownload()" class="<?php echo $bodyClassString; ?>">
<?php } else { ?>
<body class="<?php echo $bodyClassString; ?>">
<?php } ?>
  <nav class="navbar fixed-top navbar-expand-xl <?php echo $navbarColorClass; ?> py-1 navbar-custom">
    <a class="navbar-brand" href="<?php echo $homeurl; ?>">

        <svg
                width="140"
                height="40"
                viewBox="0 0 140 40"
                fill="none"
                version="1.1"
                id="svg5"
>

            <title
                    id="title1">FreeCAD-wordmark-light</title>


            <g
                    id="g1"
                    transform="matrix(0.07083333,0,0,0.07083333,7.206253,3.0000008)">
                <path
                        d="M 503.256,353 V 126.866 h 114.75 v 20.502 H 525.9 v 81.702 h 88.74 v 20.502 H 525.9 V 353 Z m 141.252,0 V 185.618 h 22.644 v 23.868 c 8.874,-18.36 23.256,-26.622 47.43,-27.846 v 22.338 c -31.518,3.06 -47.43,20.196 -47.43,51.408 V 353 Z M 895.57,276.806 H 744.1 c 1.836,33.048 30.6,59.364 65.178,59.364 25.398,0 48.96,-15.3 58.446,-38.25 h 23.562 c -12.24,35.19 -44.982,59.058 -81.396,59.058 -49.572,0 -88.434,-38.862 -88.434,-88.434 0,-48.654 38.25,-86.904 86.598,-86.904 33.048,0 62.73,17.442 77.418,45.594 7.344,14.076 10.098,27.234 10.098,49.572 z M 744.712,256.304 h 128.214 c -7.65,-33.354 -32.436,-53.856 -64.872,-53.856 -31.824,0 -57.222,21.726 -63.342,53.856 z m 349.878,20.502 H 943.119 c 1.836,33.048 30.6,59.364 65.181,59.364 25.4,0 48.96,-15.3 58.44,-38.25 h 23.57 c -12.24,35.19 -44.99,59.058 -81.4,59.058 -49.573,0 -88.435,-38.862 -88.435,-88.434 0,-48.654 38.25,-86.904 86.595,-86.904 33.05,0 62.73,17.442 77.42,45.594 7.35,14.076 10.1,27.234 10.1,49.572 z M 943.731,256.304 h 128.219 c -7.65,-33.354 -32.44,-53.856 -64.88,-53.856 -31.821,0 -57.219,21.726 -63.339,53.856 z m 348.039,33.66 h 49.27 c -17.75,41.31 -57.84,67.014 -104.35,67.014 -66.09,0 -119.03,-52.326 -119.03,-117.81 0,-63.954 52.32,-116.28 116.28,-116.28 28.46,0 55.69,9.792 76.8,27.54 14.39,12.24 21.73,22.338 30.3,41.31 h -46.82 c -15.3,-19.89 -33.05,-28.458 -59.36,-28.458 -23.26,0 -42.54,8.568 -56.31,24.786 -11.63,13.464 -18.66,33.048 -18.66,51.408 0,42.228 33.96,77.112 75.88,77.112 21.73,0 37.34,-7.344 56,-26.622 z M 1345.76,353 1440,126.866 h 33.05 L 1567.91,353 h -46.2 l -24.18,-58.446 h -80.48 L 1391.96,353 Z m 86.59,-98.532 h 48.35 l -24.17,-68.544 z M 1591.85,353 V 126.866 h 51.72 c 37.02,0 64.26,5.814 82.62,17.748 29.98,19.278 46.81,53.856 46.81,95.778 0,46.818 -21.42,84.15 -57.22,100.98 -18.05,8.262 -37.94,11.628 -71.3,11.628 z m 41.92,-40.086 h 9.18 c 25.1,0 42.54,-3.366 55.08,-10.098 20.2,-11.016 32.75,-35.19 32.75,-62.424 0,-29.682 -13.77,-54.162 -36.11,-65.178 -12.85,-6.12 -26.62,-8.262 -52.63,-8.262 h -8.27 z"
                        fill="#212529"
                        id="path5"
                        class="logo-text"
                        style="fill-opacity:1;stroke:none" />
                <g
                        id="g2"
                        style="stroke:none">
                    <path
                            d="m 400,80 -80,80 H 160 v 60 h 80 v 80 h -80 v 100 l -80,80 h 81.0076 c 6.0652,0 11.4378,-3.9054 13.3118,-9.6738 l 14.4798,-44.5656 c 1.384,-4.2618 4.7298,-7.5966 8.9916,-8.9814 l 11.1312,-3.6172 c 4.262,-1.386 8.9314,-0.65 12.5572,1.984 l 37.8994,27.5434 c 4.9066,3.5646 11.5574,3.5646 16.464,0 l 33.972,-24.691 c 4.9072,-3.5648 6.9592,-9.8788 5.085,-15.6474 l -14.4798,-44.5658 c -1.386,-4.262 -0.64,-8.9314 1.994,-12.5572 l 6.8834,-9.4672 c 2.6338,-3.6254 6.8358,-5.777 11.317,-5.7774 l 46.86,0.0102 c 6.0656,2e-4 11.4378,-3.9154 13.3118,-9.684 l 12.9812,-39.9354 c 1.874,-5.7684 -0.18,-12.093 -5.085,-15.658 L 350.7724,237.173 c -3.6256,-2.6342 -5.767,-6.8356 -5.767,-11.3172 V 214.146 c 4e-4,-4.4814 2.1412,-8.6936 5.767,-11.3274 l 43.4598,-31.5742 C 397.8584,168.6106 400,164.3988 400,159.9174 Z"
                            style="fill:#418fde;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:2.64566;stroke-linecap:square"
                            id="path8-4-4" />
                    <path
                            id="path7-7-2"
                            style="display:inline;fill:#ff585d;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:2.64566;stroke-linecap:square"
                            d="m 320,0 -80,80 h 80 v 80 L 400,80 V 0 Z M 80,320 0,400 v 80 h 80 l 80,-80 H 80 Z" />
                    <path
                            d="M 80,0 0,80 V 400 L 80,320 V 80 H 240 L 320,0 Z"
                            style="fill:#cb333b;fill-rule:evenodd;stroke:none;stroke-width:2.64566;stroke-linecap:square"
                            id="path3-1-7" />
                    <path
                            d="m 80,400 h 80 V 300 h 80 V 220 H 160 V 160 H 320 V 80 H 80 Z"
                            style="fill:#ffffff;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:2.64566;stroke-linecap:square"
                            id="path9-4-0" />
                </g>
            </g>
        </svg>


    </a>
    <ul class="nav nav-pills ms-auto order-xl-last">
      <li class="nav-item dropdown">
        <a class="nav-link <?php echo $langLinkColorClass; ?> rounded-pill dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <img src="lang/<?php echo $flagcode; ?>/flag.jpg" alt="" />
        </a>

        <div class="dropdown-menu-mobile-left dropdown-lang dropdown-menu dropdown-menu-right">
          <?php echo getFlags($currentpage); ?>
        </div>
      </li>
    </ul>


    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarNav">
      <ul class="nav nav-pills ms-auto">

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="<?php echo $featuresurl; ?>"><?php echo _('Features'); ?></a>
        </li>

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="<?php echo $downloadurl; ?>"><?php echo _('Download'); ?></a>
        </li>

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="<?php echo $blogurl; ?>"><?php echo _('Blog'); ?></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link my-2 rounded-pill dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Documentation'); ?></a>

          <div class="dropdown-menu-mobile-right dropdown-community dropdown-menu dropdown-menu-right">
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Main_Page'); ?>"><?php echo _('Documentation index'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Getting_started'); ?>"><?php echo _('Getting started'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/User_hub'); ?>"><?php echo _('Users documentation'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Manual'); ?>"><?php echo _('The FreeCAD manual'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Workbenches'); ?>"><?php echo _('Workbenches documentation'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Power_users_hub'); ?>"><?php echo _('Python coding documentation'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Developer_hub'); ?>"><?php echo _('C++ coding documentation'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Tutorials'); ?>"><?php echo _('Tutorials'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Frequently_asked_questions'); ?>"><?php echo _('Frequently asked questions'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo $privacyurl; ?>"><?php echo _('Privacy policy'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/About_FreeCAD'); ?>"><?php echo _('About FreeCAD'); ?></a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link my-2 rounded-pill dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Contribute'); ?></a>

          <div class="dropdown-menu-mobile-left dropdown-community dropdown-menu dropdown-menu-right">
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Help_FreeCAD'); ?>"><?php echo _('How to help'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo $sponsorurl; ?>"><?php echo _('Sponsor'); ?></a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD/issues"><?php echo _('Report a bug'); ?></a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD/pulls"><?php echo _('Make a pull request'); ?></a>
            <a class="dropdown-item text-dark" href="https://fpa.freecad.org/programs.html"><?php echo _('Jobs and funding'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo $contributingurl; ?>"><?php echo _('Contribution guidelines'); ?></a>
            <a class="dropdown-item text-dark" href="https://freecad.github.io/DevelopersHandbook/"><?php echo _('Developers handbook'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Localisation'); ?>"><?php echo _('Translations'); ?></a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link my-2 rounded-pill dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Community'); ?></a>

          <div class="dropdown-menu-mobile-right dropdown-community dropdown-menu dropdown-menu-right">
            <a class="dropdown-item text-dark" href="<?php echo $codeofconducturl; ?>"><?php echo _('Code of conduct'); ?></a>
            <a class="dropdown-item text-dark font-weight-bold" href="<?php echo $professionalnetworkurl; ?>"><?php echo _('Professional Network'); ?></a>
            <a class="dropdown-item text-dark font-weight-bold" href="https://forum.freecad.org/"><?php echo _('Forum'); ?></a>
            <a class="dropdown-item text-dark" href="https://fpa.freecad.org">The FPA</a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD">GitHub</a>
            <a class="dropdown-item text-dark" href="https://fosstodon.org/@FreeCAD">Mastodon</a>
            <a class="dropdown-item text-dark" href="https://matrix.to/#/#FreeCAD_FreeCAD:gitter.im">Matrix</a>
            <a class="dropdown-item text-dark" href="https://web.libera.chat/#freecad">IRC via Webchat</a>
            <a class="dropdown-item text-dark" href="https://discord.gg/w2cTKGzccC">Discord</a>
            <a class="dropdown-item text-dark" href="https://www.reddit.com/r/freecad">Reddit</a>
            <a class="dropdown-item text-dark" href="https://twitter.com/FreeCADNews">Twitter</a>
            <a class="dropdown-item text-dark" href="https://www.facebook.com/FreeCAD">Facebook</a>
            <a class="dropdown-item text-dark" href="https://www.linkedin.com/groups/4295230">LinkedIn</a>
            <a class="dropdown-item text-dark" href="<?php echo $eventsurl; ?>"><?php echo _('Calendar'); ?></a>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill donate-btn" data-bs-toggle="modal" data-bs-target="#donateModal">♥ <?php echo _('Donate'); ?></a>
        </li>

      </ul>
    </div>
  </nav>
<?php include("donation.php"); ?>
