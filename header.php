<?php
    include("translation.php");
    $homeurl = "index.php";
    $downloadurl = "downloads.php";
    $featuresurl = "features.php";
    $sponsorurl = "sponsor.php";
    $langattrib = "";
    if ($_GET["lang"] != "") {
        $homeurl = $homeurl."?lang=".$_GET["lang"];
        $downloadurl = $downloadurl."?lang=".$_GET["lang"];
        $featuresurl = $featuresurl."?lang=".$_GET["lang"];
        $sponsorurl = $sponsorurl."?lang=".$_GET["lang"];
        $langattrib = "&lang=".$_GET["lang"];
    }
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
  <link rel="stylesheet" href="css/bootstrap-4.3.1.min.css"/>

  <!-- Custom Styles -->
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
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

    <ul class="nav nav-pills ml-auto order-xl-last">
      <li class="nav-item dropdown">
        <a class="nav-link text-light rounded-pill dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <img src="lang/<?php echo $lang; ?>/flag.jpg"/>
        </a>

        <div class="dropdown-lang dropdown-menu dropdown-menu-right">
          <?php echo getFlags($currentpage); ?>
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
          <a class="nav-link my-2 rounded-pill" href="<?php echo $downloadurl; ?>"><?php echo _('Download'); ?></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link my-2 rounded-pill dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Documentation'); ?></a>

          <div class="dropdown-community dropdown-menu dropdown-menu-right">
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org'); ?>"><?php echo _('Documentation index'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Getting_started'); ?>"><?php echo _('Getting started'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/User_hub'); ?>"><?php echo _('Users documentation'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Manual'); ?>"><?php echo _('The FreeCAD manual'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Power_users_hub'); ?>"><?php echo _('Python coding documentation'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo _('https://wiki.freecad.org/Tutorials'); ?>"><?php echo _('Tutorials'); ?></a>

          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link my-2 rounded-pill dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Contribute'); ?></a>

          <div class="dropdown-community dropdown-menu dropdown-menu-right">
            <a class="dropdown-item text-dark" href="https://wiki.freecad.org/Help_FreeCAD"><?php echo _('How to help'); ?></a>
            <a class="dropdown-item text-dark" href="<?php echo $sponsorurl; ?>"><?php echo _('Donate / Sponsor'); ?></a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD/issues"><?php echo _('Report a bug'); ?></a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD/pulls"><?php echo _('Make a pull request'); ?></a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link my-2 rounded-pill dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Community'); ?></a>

          <div class="dropdown-community dropdown-menu dropdown-menu-right">
            <a class="dropdown-item text-dark font-weight-bold" href="https://forum.freecad.org/">Forum</a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FPA">The FPA</a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD">GitHub</a>
            <a class="dropdown-item text-dark" href="https://gitlab.com/freecad/FreeCAD">GitLab</a>
            <a class="dropdown-item text-dark" href="https://codeberg.org/FreeCAD/FreeCAD">Codeberg</a>
            <a class="dropdown-item text-dark" href="https://fosstodon.org/@FreeCAD">Mastodon</a>
            <a class="dropdown-item text-dark" href="https://matrix.to/#/#FreeCAD_FreeCAD:gitter.im">Matrix</a>
            <a class="dropdown-item text-dark" href="irc://irc.libera.chat/freecad">IRC</a>
            <a class="dropdown-item text-dark" href="https://web.libera.chat/#freecad">IRC via Webchat</a>
            <a class="dropdown-item text-dark" href="https://gitter.im/FreeCAD/FreeCAD">Gitter</a>
            <a class="dropdown-item text-dark" href="https://discord.gg/NpMefpXWFT">Discord</a>
            <a class="dropdown-item text-dark" href="https://www.reddit.com/r/freecad">Reddit</a>
            <a class="dropdown-item text-dark" href="https://twitter.com/FreeCADNews">Twitter</a>
            <a class="dropdown-item text-dark" href="https://www.facebook.com/FreeCAD">Facebook</a>
          </div>
        </li>

      </ul>
    </div>
  </nav>
