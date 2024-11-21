<?php
    $currentpage = "blog.php";
    include("header.php");
?>

  <script>
    var rssFeedUrl = 'proxy-xml.php?url=https://blog.freecad.org/feed/';

    var categoryImages = {
        'Development Updates': 'images/Development-Updates.avif',
        'Tutorials': 'images/Tutorials.avif',
        'User Story': 'images/User-Story.avif',
        'Events': 'images/Events.avif',
        'default': 'images/Development-Updates.avif'
    };

    var request = new XMLHttpRequest();
    request.open('GET', rssFeedUrl, true);

    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            var parser = new DOMParser();
            var rssFeed = parser.parseFromString(request.responseText, 'application/xml');

            var blogItems = rssFeed.getElementsByTagName('item');
            var blogHtml = '';

            for (var i = 0; i < blogItems.length; i++) {
                var title = blogItems[i].getElementsByTagName('title')[0].textContent;
                var link = blogItems[i].getElementsByTagName('link')[0].textContent;
                var description = blogItems[i].getElementsByTagName('description')[0].textContent;

                var contentEncoded = blogItems[i].getElementsByTagName('content:encoded')[0]?.textContent || '';
                var tempDiv = document.createElement('div');
                tempDiv.innerHTML = contentEncoded;
                var firstImage = tempDiv.querySelector('img');
                var imageUrl = firstImage ? firstImage.src : '';

                if (!imageUrl) {
                    var category = blogItems[i].getElementsByTagName('category')[0]?.textContent || 'default';
                    imageUrl = categoryImages[category] || categoryImages['default'];
                }

                var imageOrderClass = i % 2 === 1 ? 'order-lg-last' : '';

                blogHtml += `
                <section class="row section d-flex align-items-center justify-content-around rounded mb-5">
                    <div class="col-lg-5 rounded model-backround p-2 ${imageOrderClass}">
                        <img class="img-fluid" src="${imageUrl}" alt="Blog Image" loading="lazy"/>
                    </div>

                    <div class="col-lg-6 text-light text-center text-lg-start rounded text-backround">
                        <h3 class="section-title mt-3">${title}</h3>
                        <p class="section-body">
                            ${description}
                        </p>
                        <a class="btn btn-light rounded-pill mt-3" role="button" href="${link}"><?php echo _('Learn more'); ?></a>
                    </div>
                </section>
            `;
            }

            document.getElementById('rss-content').innerHTML = blogHtml;
        } else if (request.readyState === 4) {}
    };

    request.send();
  </script>

    <main id="main" class="container-fluid">
        <div id="rss-content" >
            <section class="row section d-flex align-items-center justify-content-around rounded mb-5">
                <div class="col-lg-5 rounded model-backround p-2 ">
                    <div class="placeholder-glow">
                        <div class="placeholder img-fluid bg-secondary" style="width: 100%; height: 350px;"></div>
                    </div>
                </div>
                <div class="col-lg-6 text-light text-center text-lg-start rounded text-backround">
                    <h3 class="section-title mt-3 placeholder-glow">
                        <span class="placeholder col-6 bg-secondary"></span>
                    </h3>
                    <p class="section-body placeholder-glow">
                        <span class="placeholder col-12 bg-secondary"></span>
                        <span class="placeholder col-8 bg-secondary"></span>
                        <span class="placeholder col-10 bg-secondary"></span>
                    </p>
                    <a href="#" class="btn btn-light rounded-pill mt-3 placeholder-glow disabled placeholder col-4"></a>
                </div>
            </section>

            <section class="row section d-flex align-items-center justify-content-around rounded mb-5">
                <div class="col-lg-5 rounded model-backround p-2 order-lg-last">
                    <div class="placeholder-glow">
                        <div class="placeholder img-fluid bg-secondary" style="width: 100%; height: 350px;"></div>
                    </div>
                </div>
                <div class="col-lg-6 text-light text-center text-lg-start rounded text-backround">
                    <h3 class="section-title mt-3 placeholder-glow">
                        <span class="placeholder col-6 bg-secondary"></span>
                    </h3>
                    <p class="section-body placeholder-glow">
                        <span class="placeholder col-12 bg-secondary"></span>
                        <span class="placeholder col-8 bg-secondary"></span>
                        <span class="placeholder col-10 bg-secondary"></span>
                    </p>
                    <a href="#" class="btn btn-light rounded-pill mt-3 placeholder-glow disabled placeholder col-4"></a>
                </div>
            </section>

            <section class="row section d-flex align-items-center justify-content-around rounded mb-5">
                <div class="col-lg-5 rounded model-backround p-2 ">
                    <div class="placeholder-glow">
                        <div class="placeholder img-fluid bg-secondary" style="width: 100%; height: 350px;"></div>
                    </div>
                </div>
                <div class="col-lg-6 text-light text-center text-lg-start rounded text-backround">
                    <h3 class="section-title mt-3 placeholder-glow">
                        <span class="placeholder col-6 bg-secondary"></span>
                    </h3>
                    <p class="section-body placeholder-glow">
                        <span class="placeholder col-12 bg-secondary"></span>
                        <span class="placeholder col-8 bg-secondary"></span>
                        <span class="placeholder col-10 bg-secondary"></span>
                    </p>
                    <a href="#" class="btn btn-light rounded-pill mt-3 placeholder-glow disabled placeholder col-4"></a>
                </div>
            </section>

            <section class="row section d-flex align-items-center justify-content-around rounded mb-5">
                <div class="col-lg-5 rounded model-backround p-2 order-lg-last">
                    <div class="placeholder-glow">
                        <div class="placeholder img-fluid bg-secondary" style="width: 100%; height: 350px;"></div>
                    </div>
                </div>
                <div class="col-lg-6 text-light text-center text-lg-start rounded text-backround">
                    <h3 class="section-title mt-3 placeholder-glow">
                        <span class="placeholder col-6 bg-secondary"></span>
                    </h3>
                    <p class="section-body placeholder-glow">
                        <span class="placeholder col-12 bg-secondary"></span>
                        <span class="placeholder col-8 bg-secondary"></span>
                        <span class="placeholder col-10 bg-secondary"></span>
                    </p>
                    <a href="#" class="btn btn-light rounded-pill mt-3 placeholder-glow disabled placeholder col-4"></a>
                </div>
            </section>

            <section class="row section d-flex align-items-center justify-content-around rounded mb-5">
                <div class="col-lg-5 rounded model-backround p-2 ">
                    <div class="placeholder-glow">
                        <div class="placeholder img-fluid bg-secondary" style="width: 100%; height: 350px;"></div>
                    </div>
                </div>
                <div class="col-lg-6 text-light text-center text-lg-start rounded text-backround">
                    <h3 class="section-title mt-3 placeholder-glow">
                        <span class="placeholder col-6 bg-secondary"></span>
                    </h3>
                    <p class="section-body placeholder-glow">
                        <span class="placeholder col-12 bg-secondary"></span>
                        <span class="placeholder col-8 bg-secondary"></span>
                        <span class="placeholder col-10 bg-secondary"></span>
                    </p>
                    <a href="#" class="btn btn-light rounded-pill mt-3 placeholder-glow disabled placeholder col-4"></a>
                </div>
            </section>

            <section class="row section d-flex align-items-center justify-content-around rounded mb-5">
                <div class="col-lg-5 rounded model-backround p-2 order-lg-last">
                    <div class="placeholder-glow">
                        <div class="placeholder img-fluid bg-secondary" style="width: 100%; height: 350px;"></div>
                    </div>
                </div>
                <div class="col-lg-6 text-light text-center text-lg-start rounded text-backround">
                    <h3 class="section-title mt-3 placeholder-glow">
                        <span class="placeholder col-6 bg-secondary"></span>
                    </h3>
                    <p class="section-body placeholder-glow">
                        <span class="placeholder col-12 bg-secondary"></span>
                        <span class="placeholder col-8 bg-secondary"></span>
                        <span class="placeholder col-10 bg-secondary"></span>
                    </p>
                    <a href="#" class="btn btn-light rounded-pill mt-3 placeholder-glow disabled placeholder col-4"></a>
                </div>
            </section>

            <section class="row section d-flex align-items-center justify-content-around rounded mb-5">
                <div class="col-lg-5 rounded model-backround p-2 ">
                    <div class="placeholder-glow">
                        <div class="placeholder img-fluid bg-secondary" style="width: 100%; height: 350px;"></div>
                    </div>
                </div>
                <div class="col-lg-6 text-light text-center text-lg-start rounded text-backround">
                    <h3 class="section-title mt-3 placeholder-glow">
                        <span class="placeholder col-6 bg-secondary"></span>
                    </h3>
                    <p class="section-body placeholder-glow">
                        <span class="placeholder col-12 bg-secondary"></span>
                        <span class="placeholder col-8 bg-secondary"></span>
                        <span class="placeholder col-10 bg-secondary"></span>
                    </p>
                    <a href="#" class="btn btn-light rounded-pill mt-3 placeholder-glow disabled placeholder col-4"></a>
                </div>
            </section>

            <section class="row section d-flex align-items-center justify-content-around rounded mb-5">
                <div class="col-lg-5 rounded model-backround p-2 order-lg-last">
                    <div class="placeholder-glow">
                        <div class="placeholder img-fluid bg-secondary" style="width: 100%; height: 350px;"></div>
                    </div>
                </div>
                <div class="col-lg-6 text-light text-center text-lg-start rounded text-backround">
                    <h3 class="section-title mt-3 placeholder-glow">
                        <span class="placeholder col-6 bg-secondary"></span>
                    </h3>
                    <p class="section-body placeholder-glow">
                        <span class="placeholder col-12 bg-secondary"></span>
                        <span class="placeholder col-8 bg-secondary"></span>
                        <span class="placeholder col-10 bg-secondary"></span>
                    </p>
                    <a href="#" class="btn btn-light rounded-pill mt-3 placeholder-glow disabled placeholder col-4"></a>
                </div>
            </section>

            <section class="row section d-flex align-items-center justify-content-around rounded mb-5">
                <div class="col-lg-5 rounded model-backround p-2 ">
                    <div class="placeholder-glow">
                        <div class="placeholder img-fluid bg-secondary" style="width: 100%; height: 350px;"></div>
                    </div>
                </div>
                <div class="col-lg-6 text-light text-center text-lg-start rounded text-backround">
                    <h3 class="section-title mt-3 placeholder-glow">
                        <span class="placeholder col-6 bg-secondary"></span>
                    </h3>
                    <p class="section-body placeholder-glow">
                        <span class="placeholder col-12 bg-secondary"></span>
                        <span class="placeholder col-8 bg-secondary"></span>
                        <span class="placeholder col-10 bg-secondary"></span>
                    </p>
                    <a href="#" class="btn btn-light rounded-pill mt-3 placeholder-glow disabled placeholder col-4"></a>
                </div>
            </section>

            <section class="row section d-flex align-items-center justify-content-around rounded mb-5">
                <div class="col-lg-5 rounded model-backround p-2 order-lg-last">
                    <div class="placeholder-glow">
                        <div class="placeholder img-fluid bg-secondary" style="width: 100%; height: 350px;"></div>
                    </div>
                </div>
                <div class="col-lg-6 text-light text-center text-lg-start rounded text-backround">
                    <h3 class="section-title mt-3 placeholder-glow">
                        <span class="placeholder col-6 bg-secondary"></span>
                    </h3>
                    <p class="section-body placeholder-glow">
                        <span class="placeholder col-12 bg-secondary"></span>
                        <span class="placeholder col-8 bg-secondary"></span>
                        <span class="placeholder col-10 bg-secondary"></span>
                    </p>
                    <a href="#" class="btn btn-light rounded-pill mt-3 placeholder-glow disabled placeholder col-4"></a>
                </div>
            </section>
        </div>
        <div class="text-center">
        <a class="btn btn-light rounded-pill mt-3 " role="button" href="https://blog.freecad.org/page/2/"><?php echo _('All Blogs'); ?></a>
        </div>
    </main>


<?php include 'footer.php'; ?>
