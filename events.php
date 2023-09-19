<?php
    $currentpage = "events.php";
    include("header.php");
?>

    <div id="main" class="container-fluid">

        <div class="download-notes text-center">
          <h2 class="downloads-notes-title"><?php echo _('FreeCAD events'); ?></h2>
          <p>
            <?php echo _('The calendar belows shows upcoming dates of FreeCAD meetings and other community events.'); ?>
          </p>
          <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%234285F4&showTitle=0&showPrint=0&showCalendars=0&src=NmU2Y2M4MTI2MDA1MWEzYzQ5ZmRmOTE1YzQ3MmYyZDYyNTc2ODIwMTI5ZjBlMGIyY2FjYjcwMjVlZDYyZjk2MEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%23D50000" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>
          <p>
            <?php echo _('Subscribe to this calendar using this'); ?> <a href="https://calendar.google.com/calendar/embed?src=6e6cc81260051a3c49fdf915c472f2d62576820129f0e0b2cacb7025ed62f960%40group.calendar.google.com" class="badge badge-light"><?php echo _('ICS link'); ?></a>.
          </p>
        </div>

    </div>

<?php include 'footer.php'; ?>
