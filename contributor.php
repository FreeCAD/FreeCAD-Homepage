<?php

    $currentpage = "contributor.php";
    include("header.php");
?>

    <main id="main" class="container-fluid whitelinks">

        <div class="download-notes text-center">
            <h2 class="downloads-notes-title">
                <?php echo _('Thank you for your contribution!'); ?>
            </h2>

            <p>
            <?php echo _('Thank you for supporting FreeCAD!
            Whether you donated a little or a lot, all efforts contribute to
            make FreeCAD development go further and faster.'); ?>
            </p>
            <p>
            <?php echo _('If you have made a recurring donation above 25 USD/EUR
            per month (or a one-time donation above 300 USD/EUR), you are
            eligible to become a bronze, silver or gold sponsor and can have
            your name, company name or logo displayed on the FreeCAD website,
            depending on the tier you fit in. If you have not yet informed us of
            the name you wish to see displayed, please reach to us at'); ?>
            <a href="mailto:fpa@freecad.org">fpa@freecad.org</a>.
            </p>
            <p>
            <?php echo _('Thanks!'); ?>
            </p>
            <p>
            <?php echo _('The FreeCAD project association'); ?>
            </p>

        </div>
    </main>

<?php
    include 'footer.php';
?>
