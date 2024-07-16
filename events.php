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
          <!-- google widget
          <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%234285F4&showTitle=0&showPrint=0&showCalendars=0&src=NmU2Y2M4MTI2MDA1MWEzYzQ5ZmRmOTE1YzQ3MmYyZDYyNTc2ODIwMTI5ZjBlMGIyY2FjYjcwMjVlZDYyZjk2MEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%23D50000"
                  style="border:solid 1px #777"
                  width="800" height="600"
                  frameborder="0"
                  scrolling="no">
          </iframe>
          -->
          <iframe id="open-web-calendar" 
                  style="background:url('images/loader-freecad-small.gif') center center no-repeat;"
                  src="https://open-web-calendar.hosted.quelltext.eu/calendar.html?url=https%3A%2F%2Fcalendar.google.com%2Fcalendar%2Fical%2F6e6cc81260051a3c49fdf915c472f2d62576820129f0e0b2cacb7025ed62f960%2540group.calendar.google.com%2Fpublic%2Fbasic.ics?prefer_browser_language=true"
                  sandbox="allow-scripts allow-same-origin allow-top-navigation"
                  allowTransparency="true" scrolling="no" 
                  frameborder="0" height="600px" width="100%">
          </iframe>
          <p>
            <?php echo _('Subscribe to this calendar using this'); ?> <a href="https://calendar.google.com/calendar/embed?src=6e6cc81260051a3c49fdf915c472f2d62576820129f0e0b2cacb7025ed62f960%40group.calendar.google.com" class="badge text-bg-light text-decoration-none"><?php echo _('ICS link'); ?></a>.
          </p>
        </div>

    </div>

<?php include 'footer.php'; ?>
