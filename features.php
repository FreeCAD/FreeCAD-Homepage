<?php include("translation.php"); ?>

<!DOCTYPE html>
<html lang="<?php echo $lang;?>" class="home">
<head>
	<meta charset="UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width = device-width, initial-scale = 1"/>
	<meta name="description" content="FreeCAD, the open source parametric modeler"/>
  <meta name="keywords" content="freecad, engineering, open-source, opencascade, architecture, cad, bim, fem, 3d, 3d-printing, mac-osx, linux, windows, coin, parametric-modeler"/>

	<title><?php echo _('FreeCAD: Features'); ?></title>
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
        $downloadurl = "downloads.php";
        if ($_GET["lang"] != "") {
            $indexurl = $indexurl."?lang=".$_GET["lang"];
            $downloadurl = $downloadurl."?lang=".$_GET["lang"];
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
          <a class="nav-link active my-2 rounded-pill" href="#"><?php echo _('Features'); ?></a>
        </li>

        <li class="nav-item">
          <a class="nav-link my-2 rounded-pill" href="<?php echo $downloadurl; ?>"><?php echo _('Downloads'); ?></a>
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
            <a class="dropdown-item text-dark" href="https://app.element.io/#/room/#gitter_FreeCAD=2FFreeCAD:matrix.org">Matrix</a>
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
            <a class="dropdown-item text-dark" href="https://wiki.freecadweb.org/Help_FreeCAD"><?php echo _('How to help?'); ?></a>
            <a class="dropdown-item text-dark" href="https://github.com/FreeCAD/FreeCAD/pulls"><?php echo _('Pull requests'); ?></a>
            <a class="dropdown-item text-dark" href="http://wiki.freecadweb.org/"><?php echo _('Wiki'); ?></a>
            <a class="dropdown-item text-dark" href="http://www.freecadweb.org/tracker/"><?php echo _('Bug Tracker'); ?></a>
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



        <h2 class="features-title"><?php echo _('Key FreeCAD Features'); ?></h2>



        <section class="row section d-flex justify-content-around">

          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">
            <h3><?php echo _('Made to build for the real world'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('FreeCAD is made primarily to design objects for the real world. Everything you do in FreeCAD uses real-world
              units, be it microns, kilometers, inches or feet, or even any combination of units. FreeCAD offers tools to produce, export and
              edit solid, full-precision models, export them for 3D printing or CNC machining, create 2D drawings and views of your models,
              perform analyses such as Finite Element Analyses, or export model data such as quantities or bills of materials.'); ?>
            </p>
          </div>

          <div class="col-lg-4">
            <img class="img-fluid rounded shadow" src="images/feature-06.png" alt="Feature 06"/>
          </div>

        </section>



        <section class="row section d-flex justify-content-around">

          <div class="col-lg-4">
            <img class="img-fluid rounded shadow" src="images/feature-01.jpg" alt="Feature 01"/>
          </div>

          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">
            <h3><?php echo _('A powerful solid-based geometry kernel'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('FreeCAD features an advanced geometry engine based on 
              <a href=http://en.wikipedia.org/wiki/Open_CASCADE>Open CASCADE Technology</a>. It supports solids,
              <a href=https://en.wikipedia.org/wiki/Boundary_representation>Boundary Representation</a> (BRep) objects,
              and <a href=https://en.wikipedia.org/wiki/Non-uniform_rational_B-spline>Non-uniform rational basis spline</a> (NURBS) 
              curves and surfaces, and offers a wide range of tools to create and modify these objects, including complex
              <a href=https://en.wikipedia.org/wiki/Boolean_operations_on_polygons>Boolean</a> operations, 
              <a href=https://en.wikipedia.org/wiki/Fillet_(mechanics)>fillets</a>, shape cleaning and 
              <a href="https://wiki.freecadweb.org/OpenCASCADE">much more</a>.'); ?>
            </p>
          </div>
        </section>


        <section class="row section d-flex justify-content-around">

          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">
            <h3><?php echo _('A wi(l)dly parametric environment'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('All FreeCAD objects are natively parametric, meaning their shape can be based on 
                <a href="https://wiki.freecadweb.org/Property" title="Property">properties</a> such as numeric values, texts, on/off buttons,
                or even other objects. All shape changes are recalculated on demand, recorded by an undo/redo stack, and allow to maintain
                a precise modelling history. Properties of one object can drive the value of properties of other objects, allowing
                complex, custom parametric chains that could only exist in your wildest dreams. New parametric objects are 
                <a href="https://wiki.freecadweb.org/Scripted_objects">easy to code</a>.'); ?>
            </p>
          </div>

          <div class="col-lg-4">
            <img class="img-fluid rounded shadow" src="images/feature-03.jpg" alt="Feature 03"/>
          </div>

        </section>


        <section class="row section d-flex justify-content-around">

          <div class="col-lg-4">
            <img class="img-fluid rounded shadow" src="images/feature-04.jpg" alt="Feature 04"/>
          </div>

          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">
            <h3><?php echo _('Python everywhere'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('While the FreeCAD core functionality is coded in C++ for robustness and performance, 
                  large parts of the external layers,  workbenches and and almost all the communication between 
                  the core and the user interface is coded in <a href="https://python.org">Python</a>, 
                  a flexible, user-friendly, easy to learn programming language. From Python code, you are able to
                  do just <a href="https://wiki.freecadweb.org/Power_users_hub">anything in FreeCAD</a>, from simple one-line 
                  commands in the integrated Python console to recording macros, coding your own tools up to 
                  full custom workbenches.'); ?>
            </p>
          </div>
        </section>



        <section class="row section d-flex justify-content-around">

          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">
            <h3><?php echo _('File formats frenzy'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('FreeCAD allows you to import and export models and many other kinds of data from your models such as
              analyses results or quantities data to dozens of different <a href="https://wiki.freecadweb.org/Category:File_Formats">file formats</a> such as 
              <a rel="nofollow" class="external text" href="http://en.wikipedia.org/wiki/ISO_10303">STEP</a>, 
              <a rel="nofollow" class="external text" href="http://en.wikipedia.org/wiki/IGES">IGES</a>, 
              <a rel="nofollow" class="external text" href="http://en.wikipedia.org/wiki/Obj">OBJ</a>, 
              <a rel="nofollow" class="external text" href="http://en.wikipedia.org/wiki/STL_%28file_format%29">STL</a>, 
              <a rel="nofollow" class="external text" href="http://en.wikipedia.org/wiki/.dwg">DWG</a>, 
              <a rel="nofollow" class="external text" href="http://en.wikipedia.org/wiki/Dxf">DXF</a>,
              <a rel="nofollow" class="external text" href="http://en.wikipedia.org/wiki/Svg">SVG</a>,
              <a rel="nofollow" class="external text" href="http://en.wikipedia.org/wiki/Shapefile">SHP</a>, 
              <a rel="nofollow" class="external text" href="http://en.wikipedia.org/wiki/STL_(file_format)">STL</a>, 
              <a rel="nofollow" class="external text" href="http://en.wikipedia.org/wiki/COLLADA">DAE</a>, 
              <a rel="nofollow" class="external text" href="http://en.wikipedia.org/wiki/Industry_Foundation_Classes">IFC</a> or 
              <a rel="nofollow" class="external text" href="http://people.sc.fsu.edu/~jburkardt/data/off/off.html">OFF</a>, 
              <a rel="nofollow" class="external text" href="http://en.wikipedia.org/wiki/NASTRAN">NASTRAN</a>, 
              <a rel="nofollow" class="external text" href="http://en.wikipedia.org/wiki/VRML">VRML</a>,
              <a rel="nofollow" class="external text" href="http://en.wikipedia.org/wiki/OpenSCAD">OpenSCAD CSG</a>
              and many more, in addition to FreeCAD&apos;s native 
              <a href="/File_Format_FCStd" title="File Format FCStd">FCStd</a> file format. Add-on workbenches can also add more
              file formats.'); ?>
            </p>
          </div>

          <div class="col-lg-4">
            <img class="img-fluid rounded shadow" src="images/feature-03.jpg" alt="Feature 03"/>
          </div>

        </section>


        <section class="row section d-flex justify-content-around">

          <div class="col-lg-4">
            <img class="img-fluid rounded shadow" src="images/feature-02.jpg" alt="Feature 02"/>
          </div>

          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">
            <h3><?php echo _('A parametric constraints-based 2D sketcher'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('FreeCAD features a state-of-the-art <a href="https://wiki.freecadweb.org/Sketcher_Workbench">Sketcher</a>a> 
                  with integrated constraint-solver, allowing you to sketch geometry-constrained 2D shapes. Sketches are the main 
                  building block of FreeCAD, and the constrained 2D shapes built with it may then be used as a base to build other 
                  objects throughout FreeCAD, be it either with the 
                  dedicated <a href="https://wiki.freecadweb.org/PartDesign_Workbench">Part Design workbench</a> or any other workbench.'); ?>
            </p>
          </div>
        </section>



        <section class="row section d-flex justify-content-around">

          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">
            <h3><?php echo _('A large (and growing) multi-specialty ecosystem'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('FreeCAD offers dedicated <a href="https://wiki.freecadweb.org/Workbench_Concept">workbenches</a> for a variety of purposes
              such as 
              <a href="https://wiki.freecadweb.org/Part_Workbench">CSG modeling</a>, 
              simple <a href="https://wiki.freecadweb.org/Draft_Workbench">2D CAD drafting</a>, 
              <a href="https://wiki.freecadweb.org/Surface_Module">NURBS surfaces</a>, 
              <a href="https://wiki.freecadweb.org/Arch_Module">architectural or BIM modeling</a>, 
              <a href="https://wiki.freecadweb.org/Path_Workbench">3D printing, CAM and CNC</a>,
              <a href="https://wiki.freecadweb.org/Points_Module">point clouds</a>,
              working with <a href="https://wiki.freecadweb.org/OpenSCAD_Module">OpenSCAD files</a>,
              designing <a href="https://wiki.freecadweb.org/Robot_Workbench">industrial robot trajectories</a>,
              doing <a href="https://wiki.freecadweb.org/FEM_Module">Finite Element Analyses</a>,
              and much more. FreeCAD also provides easy tools to install and manage
              <a href="https://wiki.freecadweb.org/External_workbenches">add-on workbenches</a> and
              <a href="https://wiki.freecadweb.org/Macros_recipes">macros</a> developed by the users
              community.'); ?>
            </p>
            <a class="btn btn-light rounded-pill mt-3" role="button" href="https://wiki.freecadweb.org/Feature_list">
              <?php echo _('Learn more'); ?>
            </a>
          </div>

          <div class="col-lg-4">
            <img class="img-fluid rounded shadow" src="images/feature-05.png" alt="Feature 05"/>
          </div>

        </section>


        <h2 class="features-title"><?php echo _('Release notes'); ?></h2>



        <section class="row section d-flex justify-content-around">


          <div class="col-lg-4">
            <p class="section-body whitelinks">
              <?php echo _('Find here the release notes for current and previous FreeCAD versions. 
                  Release notes describe what&apos;s new in each release:'); ?>
            </p>
          </div>

          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">
              <ul class="d-block whitelinks">
                <li><a href="https://wiki.freecadweb.org/Release_notes_011" title="Release notes 011"><?php echo _('Release 0.11 - March 2011'); ?></a></li>
                <li><a href="https://wiki.freecadweb.org/Release_notes_012" title="Release notes 012"><?php echo _('Release 0.12 - December 2011'); ?></a></li>
                <li><a href="https://wiki.freecadweb.org/Release_notes_013" title="Release notes 013"><?php echo _('Release 0.13 - January 2013'); ?></a></li>
                <li><a href="https://wiki.freecadweb.org/Release_notes_0.14" title="Release notes 0.14"><?php echo _('Release 0.14 - March 2014'); ?></a></li>
                <li><a href="https://wiki.freecadweb.org/Release_notes_0.15" title="Release notes 0.15"><?php echo _('Release 0.15 - March 2015'); ?></a></li>
                <li><a href="https://wiki.freecadweb.org/Release_notes_0.16" title="Release notes 0.16"><?php echo _('Release 0.16 - April 2016'); ?></a></li>
                <li><a href="https://wiki.freecadweb.org/Release_notes_0.17" title="Release notes 0.17"><?php echo _('Release 0.17 - April 2018'); ?></a></li>
                <li><a href="https://wiki.freecadweb.org/Release_notes_0.18" title="Release notes 0.18"><?php echo _('Release 0.18 - March 2019'); ?></a></li>
                <li><a href="https://wiki.freecadweb.org/Release_notes_0.19" title="Release notes 0.19"><?php echo _('Release 0.19 - March 2021'); ?></a> (current stable release)</li>
              </ul>
          </div>
        </section>





    </div>

<?php include 'footer.php'; ?>
