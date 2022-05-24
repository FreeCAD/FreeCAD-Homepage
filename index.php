<?php 
    $currentpage = "index.php";
    include("header.php");
?>

  <div id="main" class="container-fluid">
    <section class="row section-cover d-flex align-items-center">
      <div class="col-lg-5">
        <img class="img-fluid" src="images/cover-photo.png" alt="Cover Photo"/>
      </div>

      <div class="col-lg-7 text-center text-lg-left align-content-center order-lg-first">
        <h1 class="home-title text-light mt-n5 mb-0 mt-lg-0"><img class="home-image" src="svg/freecad-home.svg"/></h1>
        <h2 class="home-subtitle text-light mb-4"><?php echo _('Your own 3D parametric modeler'); ?></h2>
        <div class="flex-column flex-lg-row">
          <a class="btn btn-light rounded-pill mt-2" role="button" href="<?php echo $downloadurl; ?>"><?php echo _('Download now'); ?></a>
          <a class="btn btn-outline-light rounded-pill mt-2" role="button" href="https://wiki.freecad.org/Release_notes_0.19"><?php echo _("See what's new"); ?></a>
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
        <img class="img-fluid rounded shadow" src="images/screenshot-07.jpg" alt="Screenshot 7"/>
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
        <img class="img-fluid rounded shadow" src="images/screenshot-08.jpg" alt="Screenshot 8"/>
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

<?php include 'footer.php'; ?>
