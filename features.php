<?php
    $currentpage = "features.php";
    include("header.php");
?>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          var animatedSpriteElements = document.querySelectorAll('.animated-sprite');

          animatedSpriteElements.forEach(function(animatedSpriteElement) {
              setAspectRatio(animatedSpriteElement);
              setBackgroundSize(animatedSpriteElement);

              window.addEventListener('scroll', function() {
                  handleScroll(animatedSpriteElement);
              });
              handleScroll(animatedSpriteElement);
          });
      });

  function setAspectRatio(element) {
      var frameWidth = parseInt(element.getAttribute('data-frame-width'), 10);
      var frameHeight = parseInt(element.getAttribute('data-frame-height'), 10);

      if (frameWidth && frameHeight) {
          var aspectRatioPercentage = (frameHeight / frameWidth) * 100;
          element.style.setProperty('--bs-aspect-ratio', aspectRatioPercentage + '%');
      }
  }

  function setBackgroundSize(element) {
      var frameCount = parseInt(element.getAttribute('data-frame-count'), 10);
      var framesPerRow = parseInt(element.getAttribute('data-frames-per-row'), 10) || frameCount;

      var backgroundSizePercentage = framesPerRow * 100;
      element.style.backgroundSize = backgroundSizePercentage + '% auto';
  }

  function handleScroll(element) {
      var frameCount = parseInt(element.getAttribute('data-frame-count'), 10);
      var elementRect = element.getBoundingClientRect();
      var elementTopPosition = elementRect.top;
      var viewportHeight = window.innerHeight;

      var scrollProgress = (elementTopPosition - viewportHeight * 0.2) / (viewportHeight * 0.5);
      scrollProgress = 1 - Math.max(0, Math.min(1, scrollProgress));
      var currentFrame = Math.floor(scrollProgress * (frameCount - 1));

      updateBackgroundPosition(element, currentFrame);
  }

  function updateBackgroundPosition(element, frame) {
      var frameCount = parseInt(element.getAttribute('data-frame-count'), 10);
      var framesPerRow = parseInt(element.getAttribute('data-frames-per-row'), 10) || frameCount;

      var backgroundPositionX = -(frame % framesPerRow) * 100;
      var backgroundPositionY = -Math.floor(frame / framesPerRow) * 100;

      element.style.backgroundPosition = backgroundPositionX + '% ' + backgroundPositionY + '%';
  }
  </script>

    <main id="main" class="container-fluid">

        <div class="download-notes text-center">
            <h2 class="features-title"><?php echo _('Key FreeCAD Features'); ?></h2>
        </div>


        <section class="row section d-flex align-items-center justify-content-around rounded">

          <div class="col-lg-6 order-lg-last rounded model-backround p-2 d-flex justify-content-center">
            <img class="img-fluid" src="images/feature-06.avif" alt="Feature 06"/>
          </div>

          <div class="col-lg-5 text-light text-center text-lg-start px-md-4 rounded text-backround">
            <h3 class="section-title mt-3"><?php echo _('Made to build for the real world'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('FreeCAD is made primarily to design objects for the real world. Everything you do in FreeCAD uses real-world
              units, be it microns, kilometers, inches or feet, or even any combination of units. FreeCAD offers <a href=https://wiki.freecad.org/Workbenches>tools</a> to produce, export and
              edit solid, full-precision models, export them for 3D printing or CNC machining, create 2D drawings and views of your models,
              perform analyses such as Finite Element Analyses, or export model data such as quantities or bills of materials.'); ?>
            </p>
          </div>

        </section>



        <section class="row section d-flex align-items-center justify-content-around rounded">

          <div class="col-lg-6 rounded model-backround p-2 d-flex justify-content-center">
            <img class="img-fluid" src="images/feature-01.avif" alt="Feature 01"/>
          </div>

          <div class="col-lg-5 text-light text-center text-lg-start px-md-4 rounded text-backround">
            <h3 class="section-title mt-3"><?php echo _('A powerful solid-based geometry kernel'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('FreeCAD features an advanced geometry engine based on
              <a href=https://en.wikipedia.org/wiki/Open_CASCADE>Open CASCADE Technology</a>. It supports solids,
              <a href=https://en.wikipedia.org/wiki/Boundary_representation>Boundary Representation</a> (BRep) objects, and
              <a href=https://en.wikipedia.org/wiki/Non-uniform_rational_B-spline>Non-uniform rational basis spline</a> (NURBS)
              curves and surfaces, and offers a wide range of tools to create and modify these objects, including complex
              <a href=https://en.wikipedia.org/wiki/Boolean_operations_on_polygons>Boolean</a> operations,
              <a href=https://en.wikipedia.org/wiki/Fillet_(mechanics)>fillets</a>, shape cleaning and
              <a href=https://wiki.freecad.org/OpenCASCADE>much more</a>.'); ?>
            </p>
          </div>
        </section>


        <section class="row section d-flex align-items-center justify-content-around rounded">

          <div class="col-lg-6 order-lg-last rounded model-backround p-2 d-flex justify-content-center">
            <img class="img-fluid" src="images/feature-03.avif" alt="Feature 03"/>
          </div>

          <div class="col-lg-5 text-light text-center text-lg-start px-md-4 rounded text-backround">
            <h3 class="section-title mt-3"><?php echo _('A wi(l)dly parametric environment'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('All FreeCAD objects are natively parametric, meaning their shape can be based on
                <a href="https://wiki.freecad.org/Property" title="Property">properties</a> such as numeric values, texts, on/off buttons,
                or even other objects. All shape changes are recalculated on demand, recorded by an undo/redo stack, and allow to maintain
                a precise modelling history. Properties of one object can drive the value of properties of other objects, allowing
                complex, custom parametric chains that could only exist in your wildest dreams. New parametric objects are
                <a href=https://wiki.freecad.org/Scripted_objects>easy to code</a>.'); ?>
            </p>
          </div>
        </section>


        <section class="row section d-flex align-items-center justify-content-around rounded">

          <div class="col-lg-4 d-flex justify-content-center rounded model-backround p-2">
            <div class="animated-sprite ratio"
                data-frame-count="121"
                data-frames-per-row="12"
                data-frame-width="413"
                data-frame-height="400"
                style="background-image: url('images/wooden-folding-table-spritesheet.avif')">
            </div>
          </div>

          <div class="col-lg-7 text-light text-center text-lg-start px-md-4 rounded text-backround">
            <h3 class="section-title mt-3"><?php echo _('Assembly solutions for every need'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('FreeCAD has long offered several great community-made add-on assembly
                  workbenches that use different solvers and even solver-free workflows to assemble
                  the parts you create. With FreeCAD 1.0, a new built-in assembly workbench is also
                  included, based on the
                  <a href=https://github.com/Ondsel-Development/OndselSolver>Ondsel Solver</a>.
                  This workbench allows to define 3D constraints between parts, assemble the
                  different components of a model, and animate everything.'); ?>
            </p>
          </div>
        </section>


        <section class="row section d-flex align-items-center justify-content-around rounded">

          <div class="col-lg-5 order-lg-last d-flex justify-content-center rounded model-backround p-2">
            <div class="animated-sprite ratio ratio-16x9"
                data-frame-count="72"
                data-frames-per-row="12"
                style="background-image: url('images/bim-spritesheet.avif')">
            </div>
          </div>

          <div class="col-lg-6 text-light text-center text-lg-start px-md-4 rounded text-backround">
            <h3 class="section-title mt-3"><?php echo _('Also for architects'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('Until version 1.0, FreeCAD had a built-in Arch workbench and
              an external BIM workbench added on top of that. With version 1.0, both of them have
              merged and now we have a built-in BIM workbench. Now you can do your building and
              construction related projects right out of the box.'); ?>
            </p>
          </div>
        </section>


        <section class="row section d-flex align-items-center justify-content-around rounded">

          <div class="col-lg-5 rounded model-backround p-2 d-flex justify-content-center">
            <img class="img-fluid" src="images/feature-04.avif" alt="Feature 04"/>
          </div>

          <div class="col-lg-6 text-light text-center text-lg-start px-md-4 rounded text-backround">
            <h3 class="section-title mt-3"><?php echo _('Python everywhere'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('While the FreeCAD core functionality is coded in C++ for robustness and performance,
                  large parts of the external layers,  workbenches and almost all the communication between
                  the core and the user interface is coded in <a href=https://python.org>Python</a>,
                  a flexible, user-friendly, easy to learn programming language. From Python code, you are able to
                  do just <a href=https://wiki.freecad.org/Power_users_hub>anything in FreeCAD</a>, from simple one-line
                  commands in the integrated Python console to recording macros, coding your own tools up to
                  full custom workbenches.'); ?>
            </p>
          </div>
        </section>


        <section class="row section d-flex align-items-center justify-content-around rounded">

          <div class="col-lg-5 order-lg-last rounded model-backround p-2 d-flex justify-content-center">
            <img class="img-fluid" src="images/feature-08.avif" alt="Feature 08"/>
          </div>

          <div class="col-lg-6 text-light text-center text-lg-start px-md-4 rounded text-backround">
            <h3 class="section-title mt-3"><?php echo _('File formats frenzy'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('FreeCAD allows you to import and export models and many other kinds of data from your models such as
              analyses results or quantities data to dozens of different <a href="https://wiki.freecad.org/Category:File_Formats">file formats</a> such as
              <a rel="nofollow" class="external text" href="https://en.wikipedia.org/wiki/ISO_10303">STEP</a>,
              <a rel="nofollow" class="external text" href="https://en.wikipedia.org/wiki/IGES">IGES</a>,
              <a rel="nofollow" class="external text" href="https://en.wikipedia.org/wiki/Wavefront_.obj_file">OBJ</a>,
              <a rel="nofollow" class="external text" href="https://en.wikipedia.org/wiki/STL_%28file_format%29">STL</a>,
              <a rel="nofollow" class="external text" href="https://en.wikipedia.org/wiki/.dwg">DWG</a>,
              <a rel="nofollow" class="external text" href="https://en.wikipedia.org/wiki/Dxf">DXF</a>,
              <a rel="nofollow" class="external text" href="https://en.wikipedia.org/wiki/Svg">SVG</a>,
              <a rel="nofollow" class="external text" href="https://en.wikipedia.org/wiki/Shapefile">SHP</a>,
              <a rel="nofollow" class="external text" href="https://en.wikipedia.org/wiki/COLLADA">DAE</a>,
              <a rel="nofollow" class="external text" href="https://en.wikipedia.org/wiki/Industry_Foundation_Classes">IFC</a> or
              <a rel="nofollow" class="external text" href="https://en.wikipedia.org/wiki/OFF_(file_format)">OFF</a>,
              <a rel="nofollow" class="external text" href="https://en.wikipedia.org/wiki/NASTRAN">NASTRAN</a>,
              <a rel="nofollow" class="external text" href="https://en.wikipedia.org/wiki/VRML">VRML</a>,
              <a rel="nofollow" class="external text" href="https://en.wikipedia.org/wiki/OpenSCAD">OpenSCAD CSG</a>
              and many more, in addition to FreeCAD&apos;s native
              <a href="https://wiki.freecad.org/File_Format_FCStd" title="File Format FCStd">FCStd</a> file format. Add-on workbenches can also add more
              file formats.'); ?>
            </p>
          </div>
        </section>


        <section class="row section d-flex align-items-center justify-content-around rounded">

          <div class="col-lg-5 rounded model-backround p-2 d-flex justify-content-center">
            <img class="img-fluid" src="images/feature-02.avif" alt="Feature 02"/>
          </div>

          <div class="col-lg-6 text-light text-center text-lg-start px-md-4 rounded text-backround">
            <h3 class="section-title mt-3"><?php echo _('A parametric constraints-based 2D sketcher'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('FreeCAD features a state-of-the-art <a href=https://wiki.freecad.org/Sketcher_Workbench>Sketcher</a>
                  with integrated constraint-solver, allowing you to sketch geometry-constrained 2D shapes. Sketches are the main
                  building block of FreeCAD, and the constrained 2D shapes built with it may then be used as a base to build other
                  objects throughout FreeCAD, be it either with the
                  dedicated <a href=https://wiki.freecad.org/PartDesign_Workbench>Part Design workbench</a> or any other workbench.'); ?>
            </p>
          </div>
        </section>



        <section class="row section d-flex align-items-center justify-content-around rounded">

          <div class="col-lg-6 order-lg-last rounded model-backround p-2 d-flex justify-content-center">
            <img class="img-fluid" src="images/feature-05.avif" alt="Feature 05"/>
          </div>

          <div class="col-lg-5 text-light text-center text-lg-start px-md-4 rounded text-backround pb-3">
            <h3 class="section-title mt-3"><?php echo _('A large (and growing) multi-specialty ecosystem'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('FreeCAD offers dedicated <a href="https://wiki.freecad.org/Workbenches">workbenches</a> for a variety of purposes
              such as
              <a href="https://wiki.freecad.org/Part_Workbench">CSG modeling</a>,
              simple <a href="https://wiki.freecad.org/Draft_Workbench">2D CAD drafting</a>,
              <a href="https://wiki.freecad.org/Surface_Module">NURBS surfaces</a>,
              <a href="https://wiki.freecad.org/Arch_Module">architectural or BIM modeling</a>,
              <a href="https://wiki.freecad.org/Path_Workbench">3D printing, CAM and CNC</a>,
              <a href="https://wiki.freecad.org/Points_Module">point clouds</a>,
              working with <a href="https://wiki.freecad.org/OpenSCAD_Module">OpenSCAD files</a>,
              designing <a href="https://wiki.freecad.org/Robot_Workbench">industrial robot trajectories</a>,
              doing <a href="https://wiki.freecad.org/FEM_Module">Finite Element Analyses</a>,
              and much more. FreeCAD also provides easy tools to install and manage
              <a href="https://wiki.freecad.org/External_workbenches">add-on workbenches</a> and
              <a href="https://wiki.freecad.org/Macros_recipes">macros</a> developed by the users
              community.'); ?>
            </p>
            <a class="btn btn-light rounded-pill mt-3" role="button" href="<?php echo _('https://wiki.freecad.org/Feature_list'); ?>">
              <?php echo _('Learn more'); ?>
            </a>
          </div>
        </section>


        <section class="row section d-flex align-items-center justify-content-around rounded">

          <div class="col-lg-6 rounded model-backround p-2 d-flex justify-content-center">
            <img class="img-fluid" src="images/feature-07.avif" alt="Feature 07"/>
          </div>

          <div class="col-lg-5 text-light text-center text-lg-start px-md-4 rounded text-backround">
            <h3 class="section-title mt-3"><?php echo _('Developed by a community'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('FreeCAD is made for everybody, by everybody. It is developed and maintained
              by a community of developers, users, moderators, translators, all united by their wish to make
              FreeCAD a free and powerful tool. There is no commercial aim behind decisions being taken, no
              urge to make you upgrade your version of FreeCAD or to corner you into a specific workflow or
              ecosystem. FreeCAD and the files and data you produce with FreeCAD are truly yours, forever.'); ?>
            </p>
          </div>
        </section>




        <div class="download-notes text-center">
            <h2 class="features-title"><?php echo _('Release notes'); ?></h2>
        </div>



        <section class="row section d-flex align-items-center justify-content-around rounded">


          <div class="col-lg-4 rounded text-backround">
            <p class="section-body whitelinks mt-3">
              <?php echo _('Find here the release notes for current and previous FreeCAD versions.
                  Release notes describe what&apos;s new in each release:'); ?>
            </p>
          </div>

          <div class="col-lg-7 text-light text-left px-md-4 rounded text-backround">
              <ul class="d-block whitelinks releases mt-3">
                <li><a href="<?php echo _('https://wiki.freecad.org/Release_notes_1.0" title="Release notes 1.0'); ?>"><?php echo _('Release 1.0 - November 2024'); ?></a> (<?php echo _('current stable release'); ?>)</li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Release_notes_0.21" title="Release notes 0.21'); ?>"><?php echo _('Release 0.21 - August 2023'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Release_notes_0.20" title="Release notes 0.20'); ?>"><?php echo _('Release 0.20 - June 2022'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Release_notes_0.19" title="Release notes 0.19'); ?>"><?php echo _('Release 0.19 - March 2021'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Release_notes_0.18" title="Release notes 0.18'); ?>"><?php echo _('Release 0.18 - March 2019'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Release_notes_0.17" title="Release notes 0.17'); ?>"><?php echo _('Release 0.17 - April 2018'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Release_notes_0.16" title="Release notes 0.16'); ?>"><?php echo _('Release 0.16 - April 2016'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Release_notes_0.15" title="Release notes 0.15'); ?>"><?php echo _('Release 0.15 - March 2015'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Release_notes_0.14" title="Release notes 0.14'); ?>"><?php echo _('Release 0.14 - March 2014'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Release_notes_013" title="Release notes 013'); ?>"><?php echo _('Release 0.13 - January 2013'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Release_notes_012" title="Release notes 012'); ?>"><?php echo _('Release 0.12 - December 2011'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Release_notes_011" title="Release notes 011'); ?>"><?php echo _('Release 0.11 - March 2011'); ?></a></li>
              </ul>
          </div>
        </section>


        <section class="row section d-flex align-items-center justify-content-around rounded">


          <div class="col-lg-4 rounded text-backround">
            <p class="section-body whitelinks mt-3">
              <?php echo _('Follow the official FreeCAD channels for fresh news:'); ?>
            </p>
          </div>

          <div class="col-lg-7 text-light text-left px-md-4 rounded text-backround">
              <ul class="d-block whitelinks releases mt-3">
                <li><a href="https://blog.freecad.org" title="FreeCAD official blog"><?php echo _('Official blog'); ?></a></li>
                <li><a href="https://twitter.com/FreeCADNews" title="FreeCAD twitter account"><?php echo _('Twitter account'); ?></a></li>
              </ul>
          </div>
        </section>


    </main>

<?php include 'footer.php'; ?>
