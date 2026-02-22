<?php
    $currentpage = "sponsor.php";
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
          imageUrl = 'images/Development-Updates.avif';
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
  'proxy-xml.php?url=https://blog.freecad.org/category/grants/feed/',
  'grants-title',
  'grants-description',
  'grants-link',
  'grants-image'
);


    </script>
    <main id="main" class="container-fluid">

        <div class="download-notes text-center">
            <h2 class="downloads-notes-title"><?php echo _('Donating and sponsoring'); ?></h2>
        </div>


        <section class="row section d-flex justify-content-around">

          <div data-bs-toggle="modal" data-bs-target="#donateModal" class="col-lg-4">
            <h3><?php echo _('Donating to FreeCAD'); ?></h3>
          </div>

          <div class="col-lg-7 text-light text-center text-lg-start px-md-4 rounded text-backround p-3">
              <p>
              <?php echo _('Thanks for your interest in helping the FreeCAD
              project with donations.'); ?>
              </p>
              <p>
              <?php echo _('FreeCAD is a fast-growing project, developed by a
              community of developers and users working mostly on a voluntary
              basis, motivated mainly by their will to build a great, free 3D
              parametric modeller. The development of FreeCAD happens mostly
              because of the energy of all these people, without the need for
              money.'); ?>
              </p>
              <p>
              <?php echo _('However, money can help the project to achieve many
              other goals. It can help some of its developers to work more
              frequently or more regularly on the project, by paying for their
              time so they can dedicate more of it to FreeCAD, or it can help
              the community to send people to CAD-related events, so we can
              showcase FreeCAD and interest professional users. It can also help
              to organize events ourselves so community members can meet, pay for
              server space and web services, and many other things.'); ?>
              </p>
              <p class="whitelinks">
              <?php echo _('There are several ways you can donate money and help
              the FreeCAD project, being an individual, a company or an
              institution, depending on your preferences. The money you donate
              to the FreeCAD project will be received and handled by the
              <a href=https://fpa.freecad.org>FreeCAD Project Association</a>
              (FPA), a non-profit association created by FreeCAD administrators
              and core developers. The FPA will redistribute the money it gathers
              to FreeCAD developers and sponsor itself several projects, efforts
              and ideas to fuel the development of FreeCAD.'); ?>
              </p>
              <p>
              <?php echo _('Remember, however: FreeCAD is free, and will always
              be free. You are not required, and never will be, to donate anything
              in order to use FreeCAD, neither to modify or distribute it. Your
              donation will be welcome, and can help a lot, but you will never
              be required to pay anything to access any of the FreeCAD features.'); ?>
              </p>
              <a class="btn btn-light rounded-pill mt-3" data-bs-toggle="modal" data-bs-target="#donateModal">
			  ♥ <?php echo _('Donate'); ?>
			  </a>
          </div>

        </section>

        <section class="row section d-flex justify-content-around whitelinks">
          <div data-bs-toggle="modal" data-bs-target="#donateModal" data-bs-type="sponsor" data-bs-amount="200.00" class="col-lg-4">
            <h3><?php echo _('Gold sponsors'); ?></h3>
          </div>
          <div class="col-lg-7 text-light text-center text-lg-start px-md-4">

                <div class="gold sponsor">
                    <img class="logo" src="images/sponsors/microsoft.png">
                    <a class="title" href="https://www.microsoft.com/">Microsoft</a>
                    is donating hardware to the FreeCAD project
                </div>

                <div class="gold sponsor">
                    <img class="logo" src="images/sponsors/jetbrains.svg">
                    <a class="title" href="https://jb.gg/OpenSource">JetBrains</a>
                    is donating software licenses to the FreeCAD project
                </div>

                <div class="silver sponsor">
                    <img class="logo" src="images/sponsors/librespace.png">
                    <a class="title" href="https://libre.space">Libre Space Foundation</a>
                     is the non-profit foundation for open source hardware and software in space
                </div>

                <div class="gold sponsor">
                    <img class="logo" src="images/sponsors/oaktree.png">
                    <a class="title" href="https://www.oaktreellc.com/">Oaktree engineering</a>
                </div>

                <div class="gold sponsor">
                    <a class="title" href="https://spacecruft.org/">Spacecruft</a>
                </div>

                <div class="gold sponsor">
                    <img class="logo" src="images/sponsors/epiray.svg">
                    <a class="title" href="http://www.epiray.de/">Epiray</a>
                    manufactures equipment for
                    <a href="https://en.wikipedia.org/wiki/Thermal_laser_epitaxy">thermal laser epitaxy</a>
                </div>

                <div class="gold sponsor">
                    <img class="logo" src="images/sponsors/3bm.png">
                    <a class="title" href="https://3bm.co.nl/">3BM Ingenieursbureau</a>
                    is a cooperative of practical engineers acting in construction
                </div>

          </div>
        </section>

        <section class="row section d-flex justify-content-around whitelinks">
          <div class="col-lg-4">
            <h3><?php echo _('Early sponsors'); ?></h3>
          </div>
          <div class="col-lg-7 text-light text-center text-lg-start px-md-4">

                <div class="gold sponsor">
                    <img class="logo" src="images/sponsors/kanardia.png">
                    <a class="title" href="https://www.kanardia.eu/">Kanardia</a>
                    Kanardia develops and manufactures high-performance avionics
                    for ultralight aeroplanes, helicopters, and autogyros.
                </div>

                <div class="gold sponsor">
                    <img class="logo" src="images/sponsors/aleph.svg">
                    <a class="title" href="https://www.lulzbot.com/">Aleph Objects</a>
                    was a small manufacturing company based in Loveland, Colorado.
                    They are the creators of Lulzbot 3D printers
                </div>

                <div class="gold sponsor">
                    <img class="logo" src="images/sponsors/imetric4d.png">
                    <a class="title" href="https://www.imetric4d.com/">Imetric 4d</a>
                    Information Technology Company · Medical & Health
                </div>

                <div class="gold sponsor">
                    <img class="logo" src="images/sponsors/kicad.png">
                    <a class="title" href="https://www.kipro-pcb.com/">KiCad Services Corp</a>
                    is a full-service commercial
                    support corporation, formed with the mission of helping
                    professional users succeed and thrive with KiCad
                </div>

                <div class="gold sponsor">
                    <img class="logo" src="images/sponsors/openingdesign.png">
                    <a class="title" href="https://openingdesign.com">OpeningDesign</a>
                    An (uberly) transparent and open source architectural studio
                </div>

                <div class="gold sponsor">
                    <img class="logo" src="images/sponsors/wetpaint.png">
                    <a class="title" href="https://www.wetpaintdesigns.com/">Wetpaint Designs</a>
                    is a small scale manufacturer and product design firm
                </div>

          </div>
        </section>

        <section class="row section d-flex justify-content-around whitelinks">
          <div data-bs-toggle="modal" data-bs-target="#donateModal" data-bs-type="sponsor" data-bs-amount="100.00" class="col-lg-4">
            <h3><?php echo _('Silver sponsors'); ?></h3>
          </div>
          <div class="col-lg-7 text-light text-center text-lg-start px-md-4">

                <div class="silver sponsor">
                    <a href="https://route4me.com">Route4Me Route Planner</a>
                     - trusted for last-mile route planning and route optimization.
                </div>

                <div class="silver sponsor">
                    <img class="logo" src="images/sponsors/chudovo.png">
                    <a class="title" href="https://chudovo.com">Chudovo</a>
                     is an international software development company with representative
                     offices in Kyiv, Cologne, New York, Tallinn and London. It has been working
                     on the market since 2006. Company has domain expertise in video security,
                     logistics, medicine, finance
                </div>

                <div class="silver sponsor">
                    Anonymous user
                </div>

                <div class="silver sponsor">
                    <a class="title" href="#">Colombe DU POUGET DE NADAILLAC</a>
                    is a French C, C++ and Python developer who develops under UNIX her own parametric
                    drone aircraft with FreeCAD and sometimes even contributes to it by fixing bugs
                    she encounters
                </div>

                <div class="silver sponsor">
                    <img class="logo" src="images/sponsors/packt.png">
                    <a class="title" href="https://www.packtpub.com/">Packt Publishing</a>
                    is a publisher of books about open-source software
                </div>

                <div class="silver sponsor">
                    <img class="logo" src="images/sponsors/pcbway.png">
                    <a class="title" href="https://pcbway.com">PCBWay</a>
                    is a manufacturer of PCB boards, 3D-printed and CNC-produced parts
                </div>

          </div>
        </section>

        <section class="row section d-flex justify-content-around whitelinks">
          <div data-bs-toggle="modal" data-bs-target="#donateModal" data-bs-type="sponsor" data-bs-amount="25.00" class="col-lg-4">
            <h3><?php echo _('Bronze sponsors'); ?></h3>
          </div>

          <div class="col-lg-7 text-light text-center text-lg-start px-md-4">

              <div class="bronze sponsor">Artem Vasiatkin</div>
              <div class="bronze sponsor">Bystroushaak</div>
              <div class="bronze sponsor">Hydroexigiantiki SA</div>
              <div class="bronze sponsor">flightmansam</div>
              <div class="bronze sponsor">Ustun Design</div>
              <div class="bronze sponsor">Glen G</div>
              <div class="bronze sponsor">Elevated Sensors</div>
              <div class="bronze sponsor">MabeeSteve</div>
              <div class="bronze sponsor">Mario Zuena</div>
              <div class="bronze sponsor">Genysys Engine ltd</div>
              <div class="bronze sponsor">JR</div>
              <div class="bronze sponsor">Vinicius Dupuit</div>
              <div class="bronze sponsor">Brian Smith</div>
              <div class="bronze sponsor">Un voyageur avec serviette</div>
              <div class="bronze sponsor">David Yeung</div>
              <div class="bronze sponsor">Amplituda d.o.o.</div>
              <div class="bronze sponsor">plasmapotential</div>
              <div class="bronze sponsor">RobotMachines</div>
              <div class="bronze sponsor">Damian Toczek</div>
              <div class="bronze sponsor">Flaviu Tamas</div>
              <div class="bronze sponsor">Lex Heles</div>
              <div class="bronze sponsor">Brian Smith</div>
              <div class="bronze sponsor">Kliment / Future Bits</div>
              <div class="bronze sponsor">James Debono</div>
              <div class="bronze sponsor">Ian Rees</div>
              <div class="bronze sponsor">Ton Roosendaal</div>
              <div class="bronze sponsor">Robert</div>
              <div class="bronze sponsor">Lukas Alberts</div>
              <div class="bronze sponsor">Marius Grunca</div>
              <div class="bronze sponsor">Markus Vogt</div>
              <div class="bronze sponsor">Jose Alonso Mendoza</div>

          </div>
        </section>



        <section class="row section d-flex align-items-center justify-content-around rounded mb-5">
          <div class="col-lg-5 rounded model-backround p-2 ">
              <div class="placeholder-glow">
                  <img id="grants-image" class="img-fluid" alt="Grant Image" loading="lazy">
              </div>
          </div>
          <div class="col-lg-6 text-light text-center text-lg-start rounded text-backround pb-3">
              <h3 id="grants-title" class="section-title mt-3 placeholder-glow">
                  <span class="placeholder col-6 bg-secondary"></span>
              </h3>
              <p id="grants-description" class="section-body placeholder-glow">
                  <span class="placeholder col-12 bg-secondary"></span>
                  <span class="placeholder col-8 bg-secondary"></span>
                  <span class="placeholder col-10 bg-secondary"></span>
              </p>
              <a id="grants-link" href="#" class="btn btn-light rounded-pill mt-3">
                  <?php echo _('Learn more'); ?>
              </a>
          </div>
        </section>
    </main>

<?php include 'footer.php'; ?>
