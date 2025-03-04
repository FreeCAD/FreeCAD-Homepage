<?php
    $currentpage = "index.php";
    include("header.php");
?>

  <script>
    function onClickArrow() {
        document.getElementById('belowArrow').scrollIntoView();
    }
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
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
    <section class="row section-cover d-flex align-items-center">
      <div class="col-lg-8">
        <img class="img-fluid" src="images/cover-photo.avif" alt="Cover Photo"/>
      </div>

      <div class="col-lg-4 text-center text-lg-start align-content-center order-lg-first">
        <h1 class="home-title text-light mt-n5 mb-0 mt-lg-0"><img class="home-image" src="svg/freecad-home.svg" alt="FreeCAD" /></h1>
        <h2 class="home-subtitle text-light mb-4"><?php echo _('Your own 3D parametric modeler'); ?></h2>
        <div class="flex-column flex-lg-row">
          <a class="btn btn-light rounded-pill mt-2" role="button" href="<?php echo $downloadurl; ?>"><?php echo _('Download now'); ?></a>
          <a class="btn btn-outline-light rounded-pill mt-2" role="button" href="<?php echo _('https://wiki.freecad.org/Release_notes_1.0'); ?>"><?php echo _("See what's new"); ?></a>
        </div>
      </div>
    </section>

    <div class="d-flex justify-content-center"><img id="floating-arrow" src="svg/icon-down.svg" onClick="onClickArrow()" onmouseover="" style="cursor: pointer;" alt="" /></div>

    <a id="belowArrow"></a>

    <section class="row section d-flex align-items-center justify-content-around rounded">
      <div class="col-lg-7 rounded model-backround p-2" data-bs-toggle="tooltip" title="<?php echo _('Modelled by ppemawm'); ?>">
        <img class="img-fluid" src="images/screenshot-01.avif" alt="Screenshot 1"/>
      </div>

      <div class="col-lg-4 text-light text-center text-lg-start rounded text-backround">
        <h3 class="section-title mt-3"><?php echo _('Freedom to build what you want'); ?></h3>
        <p class="section-body">
          <?php echo _('FreeCAD is an open-source parametric 3D modeler made primarily to
          design real-life objects of any size. Parametric modeling allows you
          to easily modify your design by going back into your model history
          and changing its parameters.'); ?>
        </p>
      </div>
    </section>

    <section class="row section d-flex align-items-center justify-content-around rounded">
      <div class="col-lg-7 order-lg-last rounded model-backround p-2" data-bs-toggle="tooltip" title="<?php echo _('Modelled by r-frank'); ?>">
        <img class="img-fluid" src="images/screenshot-07.avif" alt="Screenshot 7"/>
      </div>

      <div class="col-lg-4 text-light text-center text-lg-start px-md-4 rounded text-backround">
        <h3 class="section-title mt-3"><?php echo _('Create 3D from 2D & back'); ?></h3>
        <p class="section-body">
          <?php echo _('FreeCAD allows you to sketch geometry constrained 2D shapes and use
          them as a base to build other objects. It contains many components
          to adjust dimensions or extract design details from 3D models to
          create high quality production ready drawings.'); ?>
        </p>
      </div>
    </section>

        <section class="row section d-flex align-items-center justify-content-around rounded">

          <div class="col-lg-7 d-flex justify-content-center rounded model-backround p-2" data-bs-toggle="tooltip" title="<?php echo _('Modelled by ppemawm'); ?>">
            <div class="animated-sprite ratio ratio-4x3"
                data-frame-count="39"
                data-frames-per-row="12"
                style="background-image: url('images/f16-main-landing-gear-spritesheet.avif')">
            </div>
          </div>

          <div class="col-lg-4 text-light text-center text-lg-start px-md-4 rounded text-backround">
            <h3 class="section-title mt-3"><?php echo _('For All Professional Needs...'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _('Looking for something that contains everything you need in an industrial environment? FreeCAD is the answer. After being available for "real work" for a very long time, it finally has become official, publishing version 1.0. Stop worrying about license costs and start doing all your professional work as a real owner.'); ?>
            </p>
          </div>
        </section>

        <section class="row section d-flex align-items-center justify-content-around rounded">

          <div class="col-lg-7 order-lg-last d-flex justify-content-center rounded model-backround p-2" data-bs-toggle="tooltip" title="<?php echo _('Baked by Kris Wilk'); ?>">
            <div class="animated-sprite ratio"
                data-frame-count="113"
                data-frames-per-row="12"
                data-frame-width="1190"
                data-frame-height="940"
                style="background-image: url('images/gingerbread-spritesheet.avif')">
            </div>
          </div>

          <div class="col-lg-4 text-light text-center text-lg-start px-md-4 rounded text-backround">
            <h3 class="section-title mt-3"><?php echo _('...and For Everything Else'); ?></h3>
            <p class="section-body whitelinks">
              <?php echo _("If you want to make something real, perhaps the first place you should visit is FreeCAD. Thanks to its vast arsenal of tools and fantastic community, it's possible to make anything you can imagine. Signing up? Not necessary. Approving anything? No way. What about the price? Good news, none! FreeCAD is a completely open source software, which makes it as free as a bird and consequently makes you also unchained without restrictions. Start using today, and say goodbye to your shackles."); ?>
            </p>
          </div>
        </section>

    <section class="row section d-flex align-items-center justify-content-around rounded">
      <div class="col-lg-7 rounded model-backround p-2" data-bs-toggle="tooltip" title="<?php echo _('Modelled by epileftric'); ?>">
        <img class="img-fluid" src="images/screenshot-03.avif" alt="Screenshot 3"/>
      </div>

      <div class="col-lg-4 text-light text-center text-lg-start px-md-4 rounded text-backround">
        <h3 class="section-title mt-3"><?php echo _('Accessible, flexible & integrated'); ?></h3>
        <p class="section-body">
          <?php echo _('FreeCAD is a multiplatform (Windows, Mac and Linux), highly
          customizable and extensible software. It reads and writes to many
          open file formats such as STEP, IGES, STL, SVG, DXF, OBJ, IFC, DAE
          and many others, making it possible to seamlessly integrate it into
          your workflow.'); ?>
        </p>
      </div>
    </section>

    <section class="row section d-flex align-items-center justify-content-around rounded">
      <div class="col-lg-7 order-lg-last rounded model-backround p-2" data-bs-toggle="tooltip" title="<?php echo _('Modelled by regis'); ?>">
        <img class="img-fluid" src="images/screenshot-08.avif" alt="Screenshot 8"/>
      </div>

      <div class="col-lg-4 text-light text-center text-lg-start px-md-4 rounded text-backround">
        <h3 class="section-title mt-3"><?php echo _('Designed for your needs'); ?></h3>
        <p class="section-body">
          <?php echo _('FreeCAD is designed to fit a wide range of uses including product
          design, mechanical engineering and architecture. Whether you are a
          hobbyist, a programmer, an experienced CAD user, a student or a
          teacher, you will feel right at home with FreeCAD.'); ?>
        </p>
      </div>
    </section>

    <section class="row section d-flex align-items-center justify-content-around rounded">
      <div class="col-lg-7 rounded model-backround p-2" data-bs-toggle="tooltip" title="<?php echo _('Modelled by rider_mortagnais'); ?>">
        <img class="img-fluid" src="images/screenshot-05.avif" alt="Screenshot 5"/>
      </div>

      <div class="col-lg-4 text-light text-center text-lg-start px-md-4 rounded text-backround pb-3">
        <h3 class="section-title mt-3"><?php echo _('And many more great features'); ?></h3>
        <p class="section-body">
          <?php echo _('FreeCAD equips you with all the right tools for your needs. You get
          modern Finite Element Analysis (FEA) tools, experimental CFD, dedicated BIM,
          Geodata or CAM/CNC workbenches, a robot simulation module that
          allows you to study robot movements and many more features. FreeCAD
          really is a Swiss Army knife of general-purpose engineering
          toolkits.'); ?>
        </p>
        <a class="btn btn-light rounded-pill mt-3" role="button" href="<?php echo $featuresurl; ?>">
          <?php echo _('Learn more'); ?>
        </a>
      </div>
    </section>

    <section class="row section d-flex align-items-center justify-content-around rounded">
      <div class="col-lg-7 order-lg-last rounded model-backround p-2" data-bs-toggle="tooltip" title="<?php echo _('Modelled by bejant'); ?>">
        <img class="img-fluid" src="images/screenshot-06.avif" alt="Screenshot 6"/>
      </div>

      <div class="col-lg-4 text-light text-center text-lg-start px-md-4 rounded text-backround pb-3">
        <h3 class="section-title mt-3"><?php echo _('Want to contribute to FreeCAD?'); ?></h3>
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
  </main>

<?php include 'footer.php'; ?>
