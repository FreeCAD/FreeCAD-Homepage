<?php include("translation.php"); ?>

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
          <a class="nav-link my-2 rounded-pill" href="https://wiki.freecadweb.org/Feature_list"><?php echo _('Features'); ?></a>
        </li>

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="<?php echo _('downloads.php'); ?>"><?php echo _('Downloads'); ?></a>
        </li>

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="https://wiki.freecadweb.org/Getting_started"><?php echo _('Documentation'); ?></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link my-2 rounded-pill dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Community'); ?></a>

          <div class="dropdown-community dropdown-menu dropdown-menu-right">
            <a class="dropdown-item text-dark font-weight-bold" href="https://forum.freecadweb.org/">Forum</a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD">GitHub</a>
            <a class="dropdown-item text-dark" href="https://gitlab.com/freecad/FreeCAD">GitLab</a>
            <a class="dropdown-item text-dark" href="https://codeberg.org/FreeCAD/FreeCAD">Codeberg</a>
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
            <a class="dropdown-item text-dark" href="https://wiki.freecadweb.org/Help_FreeCAD">How to help?</a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD/pulls">Pull requests</a>
            <a class="dropdown-item text-dark" href="http://wiki.freecadweb.org/">Wiki</a>
            <a class="dropdown-item text-dark" href="http://www.freecadweb.org/tracker/">Bug Tracker</a>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="https://wiki.freecadweb.org/Donate"><?php echo _('Donate'); ?></a>
        </li>

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="https://forum.freecadweb.org/viewforum.php?f=24"><?php echo _('Showcase'); ?></a>
        </li>
      </ul>
    </div>
  </nav>

  <div id="main" class="container-fluid">
    <section class="row section-cover d-flex align-items-center">
      <div class="col-lg-5">
        <img class="img-fluid" src="images/cover-photo.png" alt="Cover Photo"/>
      </div>

      <div class="col-lg-7 text-center text-lg-left align-content-center order-lg-first">
        <h1 class="home-title text-light mt-n5 mb-0 mt-lg-0"><?php echo _('FreeCAD'); ?></h1>
        <h2 class="home-subtitle text-light mb-4"><?php echo _('Your own 3D parametric modeler'); ?></h2>
        <div class="flex-column flex-lg-row">
          <a class="btn btn-light rounded-pill mt-2" role="button" href="downloads.php"><?php echo _('Download now'); ?></a>
          <a class="btn btn-outline-light rounded-pill mt-2" role="button" href="https://www.youtube.com/watch?v=85HlYXnaxbw"><?php echo _("See what's new"); ?></a>
        </div>
      </div>
    </section>

    <div class="d-flex justify-content-center"><img id="floating-arrow" src="svg/icon-down.svg"/></div>

    <section class="row section d-flex align-items-center justify-content-around">
      <div class="col-lg-7">
        <img class="img-fluid rounded shadow" src="images/screenshot-01.jpg" alt="Screenshot 1"/>
      </div>

      <div class="col-lg-4 text-light text-center text-lg-left">
        <h3 class="section-title mt-4 mt-lg-0"><?php echo _('Freedom to build what you want'); ?></h3>
        <p class="section-body">
          <?php echo _('FreeCAD is an open-source parametric 3D modeler made primarily to
          design real-life objects of any size. Parametric modeling allows you
          to easily modify your design by going back into your model history
          and changing its parameters.'); ?>
        </p>
      </div>
    </section>

    <section class="row section d-flex align-items-center justify-content-around">
      <div class="col-lg-7 order-lg-last">
        <img class="img-fluid rounded shadow" src="images/screenshot-02.jpg" alt="Screenshot 2"/>
      </div>

      <div class="col-lg-4 text-light text-center text-lg-left px-md-4">
        <h3 class="section-title mt-4 mt-lg-0"><?php echo _('Create 3D from 2D & back'); ?></h3>
        <p class="section-body">
          <?php echo _('FreeCAD allows you to sketch geometry constrained 2D shapes and use
          them as a base to build other objects. It contains many components
          to adjust dimensions or extract design details from 3D models to
          create high quality production ready drawings.'); ?>
        </p>
      </div>
    </section>

    <section class="row section d-flex align-items-center justify-content-around">
      <div class="col-lg-7">
        <img class="img-fluid rounded shadow" src="images/screenshot-03.jpg" alt="Screenshot 3"/>
      </div>

      <div class="col-lg-4 text-light text-center text-lg-left px-md-4">
        <h3 class="section-title mt-4 mt-lg-0"><?php echo _('Accessible, flexible & integrated'); ?></h3>
        <p class="section-body">
          <?php echo _('FreeCAD is a multiplatfom (Windows, Mac and Linux), highly
          customizable and extensible software. It reads and writes to many
          open file formats such as STEP, IGES, STL, SVG, DXF, OBJ, IFC, DAE
          and many others, making it possible to seamlessly integrate it into
          your workflow.'); ?>
        </p>
      </div>
    </section>

    <section class="row section d-flex align-items-center justify-content-around">
      <div class="col-lg-7 order-lg-last">
        <img class="img-fluid rounded shadow" src="images/screenshot-04.jpg" alt="Screenshot 4"/>
      </div>

      <div class="col-lg-4 text-light text-center text-lg-left px-md-4">
        <h3 class="section-title mt-4 mt-lg-0"><?php echo _('Designed for your needs'); ?></h3>
        <p class="section-body">
          <?php echo _('FreeCAD is designed to fit a wide range of uses including product
          design, mechanical engineering and architecture. Whether you are a
          hobbyist, a programmer, an experienced CAD user, a student or a
          teacher, you will feel right at home with FreeCAD.'); ?>
        </p>
      </div>
    </section>

    <section class="row section d-flex align-items-center justify-content-around">
      <div class="col-lg-7">
        <img class="img-fluid rounded shadow" src="images/screenshot-05.jpg" alt="Screenshot 5"/>
      </div>

      <div class="col-lg-4 text-light text-center text-lg-left px-md-4">
        <h3 class="section-title mt-4 mt-lg-0"><?php echo _('And many more great features'); ?></h3>
        <p class="section-body">
          <?php echo _('FreeCAD equips you with all the right tools for your needs. You get
          modern Finite Element Analysis (FEA) tools, experimental CFD, BIM,
          Geodata workbenches, Path workbench, a robot simulation module that
          allows you to study robot movements and many more features. FreeCAD
          really is a Swiss Army knife of general-purpose engineering
          toolkits.'); ?>
        </p>
        <a class="btn btn-light rounded-pill mt-3" role="button" href="https://wiki.freecadweb.org/Feature_list#General_features:">
          <?php echo _('Learn more'); ?>
        </a>
      </div>
    </section>

    <section class="row section d-flex align-items-center justify-content-around">
      <div class="col-lg-7 order-lg-last">
        <img class="img-fluid rounded shadow" src="images/screenshot-06.jpg" alt="Screenshot 6"/>
      </div>

      <div class="col-lg-4 text-light text-center text-lg-left px-md-4">
        <h3 class="section-title mt-4 mt-lg-0"><?php echo _('Want to contribute to FreeCAD?'); ?></h3>
        <p class="section-body">
          <?php echo _('FreeCAD is a truly open source project and if you would like to help
          fix bugs, implement new cool features or work on the documentation,
          we invite you to join us and create a software that benefits the
          whole community.'); ?>
        </p>
        <a class="btn btn-light rounded-pill mt-3" role="button" href="https://github.com/FreeCAD/FreeCAD/">
          <?php echo _('Get involved'); ?>
        </a>
      </div>
    </section>
  </div>

  <footer class="container-fluid footer-custom bg-dark text-center text-light">
    <div class="row">
      <div class="col-md-4 col-sm-6 mb-3">
        <h4><?php echo _('Learn'); ?></h4>
        <ul class="list-unstyled">
          <li><a class="text-light" href="https://wiki.freecadweb.org/Tutorials"><?php echo _('Tutorials'); ?></a></li>
          <li><a class="text-light" href="https://www.youtube.com/results?search_query=freecad"><?php echo _('Videos'); ?></a></li>
          <li><a class="text-light" href="https://stackexchange.com/search?q=freecad">Stack Exchange</a></li>
        </ul>
      </div>

      <div class="col-md-4 col-sm-6 mb-3">
        <h4><?php echo _('Contribute'); ?></h4>
        <ul class="list-unstyled">
          <li><a class="text-light" href="https://wiki.freecadweb.org/Help_FreeCAD"><?php echo _('How can I help?'); ?></a></li>
          <li><a class="text-light" href="https://wiki.freecadweb.org/Donate"><?php echo _('Donate'); ?></a></li>
          <li><a class="text-light" href="https://crowdin.com/project/freecad"><?php echo _('Translate'); ?></a></li>
        </ul>
      </div>

      <div class="col-md-4 col-sm-6 mb-3">
        <h4><?php echo _('Code'); ?></h4>
        <ul class="list-unstyled">
          <li><a class="text-light" href="https://wiki.freecadweb.org/Compiling"><?php echo _('Building from source'); ?></a></li>
          <li><a class="text-light" href="https://www.freecadweb.org/api/"><?php echo _('C++ & Python API'); ?></a></li>
          <li><a class="text-light" href="https://wiki.freecadweb.org/Licence"><?php echo _('License information'); ?></a></li>
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

    <p>This project is supported by:</p>
    <p>
      <a href="https://www.digitalocean.com/?utm_medium=opensource&utm_source=FreeCAD">
        <img src="https://opensource.nyc3.cdn.digitaloceanspaces.com/attribution/assets/SVG/DO_Logo_horizontal_blue.svg" width="201px">
      </a>
    </p>
  </footer>

  <!-- Include Bootstrap JS files -->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper-1.14.7.min.js"></script>
  <script src="js/bootstrap-4.3.1.min.js"></script>
</body>

</html>
