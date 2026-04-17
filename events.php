<?php
    $currentpage = "events.php";
    include("header.php");
?>
    <script>
function updateLatestCategoryFromFeed(xmlUrl, titleId, bodyId, buttonId, imageId) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', xmlUrl, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var parser = new DOMParser();
      var xml = parser.parseFromString(xhr.responseText, 'application/xml');

      var latestEventsPost = xml.getElementsByTagName('item')[0];

      var sectionTitle = document.getElementById(titleId);
      var sectionBody = document.getElementById(bodyId);
      var learnMoreButton = document.getElementById(buttonId);
      var imageElement = document.getElementById(imageId);

      if (latestEventsPost) {
        sectionTitle.textContent = latestEventsPost.getElementsByTagName('title')[0].textContent;
        sectionBody.innerHTML = latestEventsPost.getElementsByTagName('description')[0].textContent;
        learnMoreButton.setAttribute('href', latestEventsPost.getElementsByTagName('link')[0].textContent);

        var contentEncoded = latestEventsPost.getElementsByTagName('content:encoded')[0]?.textContent || '';
        var tempDiv = document.createElement('div');
        tempDiv.innerHTML = contentEncoded;
        var firstImage = tempDiv.querySelector('img');
        var imageUrl = firstImage ? firstImage.src : '';

        if (!imageUrl) {
          imageUrl = 'images/Events.avif';
        }

        if (imageElement) {
          imageElement.setAttribute('src', imageUrl);
        }
      }
    }
  };
  xhr.send();
}

updateLatestCategoryFromFeed(
  'proxy-xml.php?url=https://blog.freecad.org/category/events/feed/',
  'events-title',
  'events-description',
  'events-link',
  'events-image'
);


    </script>

    <main id="main" class="container-fluid">

        <div class="download-notes text-center">
          <h2 class="downloads-notes-title"><?php echo _('FreeCAD events'); ?></h2>
          <p>
            <?php echo _('The calendar belows shows upcoming dates of FreeCAD meetings and other community events.'); ?>
          </p>
          <iframe id="open-web-calendar"
                  style="background:url('images/loader-freecad-small.gif') center center no-repeat;"
                  src="https://cloud.freecad.org/apps/calendar/embed/ZtJiizXtSqBaacwo"
                  sandbox="allow-scripts allow-same-origin allow-top-navigation"
                  allowTransparency="true" scrolling="no"
                  frameborder="0" height="800px" width="100%">
          </iframe>
          <p>
            <?php echo _('Subscribe to this calendar using this'); ?> <a href="https://cloud.freecad.org/remote.php/dav/public-calendars/ZtJiizXtSqBaacwo?export" class="badge text-bg-light text-decoration-none"><?php echo _('ICS link'); ?></a>.
          </p>
        </div>

            <section class="row section d-flex align-items-center justify-content-around rounded mb-5">
                <div class="col-lg-5 rounded model-backround p-2 ">
                    <div class="placeholder-glow">
                        <img id="events-image" class="img-fluid" alt="Event Image" loading="lazy">
                    </div>
                </div>
                <div class="col-lg-6 text-light text-center text-lg-start rounded text-backround pb-3">
                    <h3 id="events-title" class="section-title mt-3 placeholder-glow">
                        <span class="placeholder col-6 bg-secondary"></span>
                    </h3>
                    <p id="events-description" class="section-body placeholder-glow">
                        <span class="placeholder col-12 bg-secondary"></span>
                        <span class="placeholder col-8 bg-secondary"></span>
                        <span class="placeholder col-10 bg-secondary"></span>
                    </p>
                    <a id="events-link" href="#" class="btn btn-light rounded-pill mt-3">
                        <?php echo _('Learn more'); ?>
                    </a>
                </div>
            </section>

    </main>

<?php include 'footer.php'; ?>
