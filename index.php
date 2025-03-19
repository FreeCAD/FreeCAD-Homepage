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


    <section class="row section d-flex align-items-center justify-content-around rounded">
      <div class="col-lg-7 rounded model-backround p-2" data-bs-toggle="tooltip" title="<?php echo _('PUMA microscope developed by Paul Tadrous'); ?>">
        <a href="https://blog.freecad.org/2023/02/13/a-research-grade-open-source-microscope-made-with-freecad">
          <img class="img-fluid" src="images/PUMA_Frontice.avif" alt="PUMA Frontice"/>
        </a>
      </div>

      <div class="col-lg-4 text-light text-center text-lg-start px-md-4 rounded text-backround">
        <h3 class="section-title mt-3"><?php echo _('Extremely Scientific'); ?></h3>
        <p class="section-body whitelinks">
          <?php echo _("FreeCAD is an open-source tool where you can understand how every component works, making it ideal for scientific projects. Its Python integration and active community further enhance its appeal. Over the years, FreeCAD has been both the subject and tool of many studies. If your research could benefit the FreeCAD community, consider applying for a grant from the <a href=https://fpa.freecad.org/>FreeCAD Project Association<a>."); ?>
        </p>
        <a class="btn btn-light rounded-pill mt-3" role="button" href="<?php echo $researchurl; ?>">
          <?php echo _('Learn more'); ?>
        </a>
      </div>
    </section>

  </div>

  </main>


<?php include 'footer.php'; ?>
