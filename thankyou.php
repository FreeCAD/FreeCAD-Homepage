<?php

    $currentpage = "thankyou.php";
    include("header.php");

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    if ( !function_exists('str_starts_with') ) {
        function str_starts_with ( $haystack, $needle ) {
            return strpos( $haystack , $needle ) === 0;
        }
    }

    $url = "#";
    if (isset($_GET['url']) ) {
        $url = urldecode($_GET['url']);
        // Only allow downloads from trusted source
        if ( !str_starts_with($url, "https://github.com/FreeCAD/FreeCAD/releases") ) {
            $url = "#";
        }
        if ( strpos( $url, ".." ) !== false ) {
            $url = "#";
        }
        if ( strpos( $url, "\"" ) !== false ) {
            $url = "#";
        }
        if ( strpos( $url, "(" ) !== false ) {
            $url = "#";
        }
        if ( strpos( $url, ";" ) !== false ) {
            $url = "#";
        }
        if ( strpos( $url, "%" ) !== false ) {
            $url = "#";
        }
        // for some reason this does not work on our version of php
        //if ( !str_ends_with($url, ".7z") ) {
        //    if ( !str_ends_with($url, ".exe") ) {
        //        if ( !str_ends_with($url, ".dmg") ) {
        //            if ( !str_ends_with($url, ".AppImage") ) {
        //                $url = "#";
        //            }
        //        }
        //    }
        //}
    }
?>

    <script>
        function startDownload() {
            window.location = "<?php echo $url; ?>";
        }
    </script>

    <main id="main" class="container-fluid">

        <div class="download-notes text-center">
            <h2 class="downloads-notes-title"><?php echo _('Thank you!'); ?></h2>

            <p>
            <?php echo _('Your download should start automatically.
            If not, click') ?> <a href="<?php echo $url; ?>"><?php echo _('here'); ?></a>
            <?php echo _('to download the file.'); ?>
            </p>

        </div>

        <section class="row section d-flex justify-content-around">


          <div class="col-lg-4">
            <h3><?php echo _('Support FreeCAD!'); ?></h3>
          </div>

          <div class="col-lg-7 text-light text-center text-lg-start px-md-4 rounded text-backround p-3">

            <p>
            <?php echo _('If you are happy with FreeCAD, and would like to help
            it thrive, why not donate a bit of money to the project? Being
            open-source, paying to use FreeCAD will never be required, and
            FreeCAD does not need money to survive, but donations help us to go
            further, faster.'); ?>
            </p>

            <p>
            <?php echo _('If you are in, choose the amount and method of your choice below. If you are interested in supporting the project better with a recurring donation, check the <a data-bs-toggle="modal" data-bs-target="#donateModal">donate page</a> to see more options.'); ?>
            </p>

            <p class="whitelinks">
            <?php echo _('There are also many other ways to help FreeCAD. For
            example, you can write code, help writing documentation, translate
            the FreeCAD interface and documentation, help new users, etc. See
            all you need to know on the
            <a href=https://wiki.freecad.org/Help_FreeCAD>Help FreeCAD</a>
            page.'); ?>
            </p>
            <a class="btn btn-light rounded-pill mt-3" data-bs-toggle="modal" data-bs-target="#donateModal">
            ♥ <?php echo _('Donate'); ?>
            </a>

          </div>
        </section>


        <section class="row section d-flex justify-content-around">
          <div class="col-lg-4">
            <h3><?php echo _('Need help?'); ?></h3>
          </div>

          <div class="col-lg-7 text-light text-center text-lg-start px-md-4 rounded text-backround p-3">

            <p class="whitelinks">
            <?php echo _('If you are new to FreeCAD, or to 3D CAD modelling, we
            have you covered! FreeCAD features an
            <a href=https://wiki.freecad.org>extensive documentation</a>, which
            is available online but also directly within the FreeCAD application.
            It covers everything from installing and launching FreeCAD, using it
            and its different workbenches, up to creating Python scripts to
            automate it and developing your own tools and extensions.'); ?>
            </p>

            <p>
            <?php echo _('Below are some pages of this documentation that could
            be useful to you:'); ?>
            </p>

            <ul class="d-block whitelinks">
                <li><a href="<?php echo _('https://wiki.freecad.org/Installing_on_Windows'); ?>"><?php echo _('Installing FreeCAD on Windows'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Installing_on_Linux'); ?>"><?php echo _('Installing FreeCAD on Linux'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Installing_on_Mac'); ?>"><?php echo _('Installing FreeCAD on MacOS'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Installing_additional_components'); ?>"><?php echo _('Installing additional components'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Getting_started'); ?>"><?php echo _('Getting started with FreeCAD'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/User_hub#Migrating_from_other_software.3F'); ?>"><?php echo _('Migrating from other software?'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Workbenches'); ?>"><?php echo _('Workbenches documentation'); ?></a></li>
                <li><a href="<?php echo _('https://wiki.freecad.org/Frequently_asked_questions'); ?>"><?php echo _('Frequently asked questions'); ?></a></li>
            </ul>

            <p>
            <?php echo _('FreeCAD also offers a complete user manual, that can
            be downloaded as a pdf or epub file or printed:'); ?>
            </p>

            <ul class="d-block whitelinks">
                <li><a href="<?php echo _('https://wiki.freecad.org/Manual'); ?>"><?php echo _('The FreeCAD user manual'); ?></a></li>
            </ul>

            <p>
            <?php echo _('and many tutorials, in written or video form, created by
            the FreeCAD community:'); ?>
            </p>

            <ul class="d-block whitelinks">
                <li><a href="<?php echo _('https://wiki.freecad.org/Tutorials'); ?>"><?php echo _('Tutorials'); ?></a></li>
            </ul>

            <p>
            <?php echo _('On behalf of all of the worldwide community of users,
            developers, translators, editors, writers, testers who work hard to
            make FreeCAD the best CAD modeller out there, we thank you for
            downloading our baby! We hope you will like it as much as we do.'); ?>
            </p>

            <p class="whitelinks">
            <?php echo _('If you encounter issues with FreeCAD, or would like to
            meet and discuss topics with other users, pay a visit to the
            <a href=https://forum.freecad.org>FreeCAD forum</a>. The forum is the
            main meeting point for FreeCAD users of all parts of the world and all
            skill levels. There you can seek advice of more advanced users, find
            ways to solve a particular problem, or discuss ideas about and around
            the FreeCAD world.'); ?>
            </p>

          </div>

        </section>
    </main>

<?php
    include 'footer.php';
?>
