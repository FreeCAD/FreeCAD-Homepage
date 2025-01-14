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

  <!-- Include bootstrap CSS file -->
   <link rel="stylesheet" href="css/bootstrap-5.3.3.min.css"/>

  <!-- Custom Styles -->
  <link rel="stylesheet" type="text/css" href="css/style.css"/>

  <!-- Social networks -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@FreeCADNews" />
  <meta name="twitter:creator" content="@FreeCADNews" />
  <meta property="og:title" content="<?php echo _('FreeCAD: Your own 3D parametric modeler'); ?>" />
  <meta property="og:description" content="FreeCAD, the open source 3D parametric modeler" />
  <meta property="og:image" content="https://freecad.org/images/banner.jpg" />

</head>

<?php if ($currentpage == "thankyou.php") { ?>
<body onload="startDownload()">
<?php } else { ?>
<body>
<?php } ?>
  <nav class="navbar fixed-top navbar-expand-xl navbar-dark py-1 navbar-custom">
    <a class="navbar-brand" href="<?php echo $homeurl; ?>">
      <img class="img-fluid" src="svg/logo-freecad.svg" alt="FreeCAD Logo"/>
    </a>
    <a class="navbar-brand" href="<?php echo $downloadurl; ?>">
      <img class="img-fluid" src="svg/stylized-1.0.svg" alt="FreeCAD 1.0"/>
    </a>
    <ul class="nav nav-pills ms-auto order-xl-last">
      <li class="nav-item dropdown">
        <a class="nav-link text-light rounded-pill dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
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
          <a class="nav-link my-2 rounded-pill" href="<?php echo _('https://wiki.freecad.org/Main_Page'); ?>"><?php echo _('Documentation'); ?></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link my-2 rounded-pill dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Contribute'); ?></a>

          <div class="dropdown-menu-mobile-left dropdown-community dropdown-menu dropdown-menu-right">
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Help_FreeCAD'); ?>"><?php echo _('How to help'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo $sponsorurl; ?>"><?php echo _('Donate / Sponsor'); ?></a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD/issues"><?php echo _('Report a bug'); ?></a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD/pulls"><?php echo _('Make a pull request'); ?></a>
            <a class="dropdown-item text-dark" href="https://fpa.freecad.org/programs.html"><?php echo _('Jobs and funding'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo $contributingurl; ?>"><?php echo _('Contribution guidelines'); ?></a>
            <a class="dropdown-item text-dark" href="https://freecad.github.io/DevelopersHandbook/"><?php echo _('Developers handbook'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Localisation'); ?>"><?php echo _('Translations'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo $privacyurl; ?>"><?php echo _('Privacy policy'); ?></a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link my-2 rounded-pill dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Community'); ?></a>

          <div class="dropdown-menu-mobile-right dropdown-community dropdown-menu dropdown-menu-right">
            <a class="dropdown-item text-dark" href="<?php echo $codeofconducturl; ?>"><?php echo _('Code of conduct'); ?></a>
            <a class="dropdown-item text-dark font-weight-bold" href="https://forum.freecad.org/"><?php echo _('Forum'); ?></a>
            <a class="dropdown-item text-dark" href="https://fpa.freecad.org">The FPA</a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD">GitHub</a>
            <a class="dropdown-item text-dark" href="https://gitlab.com/freecad/FreeCAD">GitLab</a>
            <a class="dropdown-item text-dark" href="https://codeberg.org/FreeCAD/FreeCAD">Codeberg</a>
            <a class="dropdown-item text-dark" href="https://fosstodon.org/@FreeCAD">Mastodon</a>
            <a class="dropdown-item text-dark" href="https://matrix.to/#/#FreeCAD_FreeCAD:gitter.im">Matrix</a>
            <a class="dropdown-item text-dark" href="irc://irc.libera.chat/freecad">IRC</a>
            <a class="dropdown-item text-dark" href="https://web.libera.chat/#freecad">IRC via Webchat</a>
            <a class="dropdown-item text-dark" href="https://gitter.im/FreeCAD/FreeCAD">Gitter</a>
            <a class="dropdown-item text-dark" href="https://discord.gg/w2cTKGzccC">Discord</a>
            <a class="dropdown-item text-dark" href="https://www.reddit.com/r/freecad">Reddit</a>
            <a class="dropdown-item text-dark" href="https://twitter.com/FreeCADNews">Twitter</a>
            <a class="dropdown-item text-dark" href="https://www.facebook.com/FreeCAD">Facebook</a>
            <a class="dropdown-item text-dark" href="https://www.linkedin.com/groups/4295230">LinkedIn</a>
            <a class="dropdown-item text-dark" href="<?php echo $eventsurl; ?>"><?php echo _('Calendar'); ?></a>
          </div>
        </li>

      </ul>
    </div>
  </nav>
