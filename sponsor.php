<?php
    $currentpage = "sponsor.php";
    include("header.php");
?>

    <div id="main" class="container-fluid whitelinks">

        <div class="download-notes text-center">
            <h2 class="downloads-notes-title"><?php echo _('Donating and sponsoring'); ?></h2>
        </div>


        <section class="row section d-flex justify-content-around whitelinks">

          <div class="col-lg-4">
            <h3><?php echo _('Donating to FreeCAD'); ?></h3>
          </div>

          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">
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
              <p>
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
          </div>

        </section>



        <section class="row section d-flex justify-content-around">

          <div class="col-lg-4">
            <h3><?php echo _('One-time donation'); ?></h3>
          </div>

          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">
              <p>
              <?php echo _('If you are not sure or not able to commit to a regular
              donation, but still want to help the project, you can do a one-time
              donation, of any amount.'); ?>
              </p>
              <p>
              <?php echo _('Choose freely the amount you wish to donate one
              time only:'); ?>
              </p>
              <?php $formid = "donation"; include("donation.php"); ?>

          </div>

        </section>




        <section class="row section d-flex justify-content-around">

          <div class="col-lg-4">
            <h3><?php echo _('Sponsoring'); ?></h3>
          </div>

          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">
              <p>
              <?php echo _('We call sponsoring the act of donating money
              recurrently to the FreeCAD project. You can do that as an
              individual or as a company or institution, through different
              channels or platforms, depending on your preferences.'); ?>
              </p>
              <p>
              <?php echo _('Sponsoring FreeCAD allows its developers to count on
              a steady flow of income, so it allows the FPA to plan things ahead,
              and the FreeCAD developers to invest themselves more seriously
              into FreeCAD.'); ?>
              </p>
              <p>
              <?php echo _('To encourage persons and companies to sponsor the
              FreeCAD project, we have created different sponsoring tiers. When
              donating regularly to the project, unless you prefer to stay
              anonymous, your name, company name and/or logo will be featured
              on this website, depending on the tier you fit into:'); ?>
              </p>
              <ul class="sponsortitle">
                <li>♥ <b class="normal"><?php echo _('Normal sponsor'); ?></b>:
                <?php echo _('from 1 USD / 1 EUR per month. You will not have your
                name displayed here, but you will have helped the project a lot
                anyway. Together, normal sponsors maintain the project on its
                feet as much as the bigger sponsors.'); ?></li>
                <li><b class="bronze">🥉 <?php echo _('Bronze sponsor'); ?></b>:
                <?php echo _('from 25 USD / 25 EUR per month. Your name or
                company name is displayed on this page.'); ?></li>
                <li><b class="silver">🥈 <?php echo _('Silver sponsor'); ?></b>:
                <?php echo _('from 100 USD / 100 EUR per month. Your name or
                company name is displayed on this page, with a link to
                your website, and a one-line description text.'); ?></li>
                <li><b class="gold">🥇 <?php echo _('Gold sponsor'); ?></b>:
                <?php echo _('from 200 USD / 200 EUR per month. Your name
                or company name and logo displayed on this page,
                with a link to your website and a custom description text.
                Companies that have helped FreeCAD early on also appear
                under Gold sponsors.'); ?></li>
              </ul>
              <p>
              <?php echo _("Instead of donating each month, you might find it
              more comfortable to make a one-time donation that, when divided by
              twelve, would give you right to enter a sponsoring tier. Don't
              hesitate to do so!"); ?>
              </p>
              <p>
              <?php echo _('Choose freely the amount you wish to donate each
              month:'); ?>
              </p>
              <?php $formid = "sponsor"; include("donation.php"); ?>
              <p>
              <?php echo _('Please inform your forum name or twitter handle as a note
              in your transfer, or <a href=mailto:fpa@freecad.org>reach to us</a>,
              so we can give you proper credits!'); ?>
              </p>
          </div>

        </section>


        <section class="row section d-flex justify-content-around">
          <div class="col-lg-4">
            <h3><?php echo _('Gold sponsors'); ?></h3>
          </div>
          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">

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

        <section class="row section d-flex justify-content-around">
          <div class="col-lg-4">
            <h3><?php echo _('Early sponsors'); ?></h3>
          </div>
          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">

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

        <section class="row section d-flex justify-content-around">
          <div class="col-lg-4">
            <h3><?php echo _('Silver sponsors'); ?></h3>
          </div>
          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">

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

        <section class="row section d-flex justify-content-around">
          <div class="col-lg-4">
            <h3><?php echo _('Bronze sponsors'); ?></h3>
          </div>

          <div class="col-lg-7 text-light text-center text-lg-left px-md-4">

              <div class="bronze sponsor">James Debono</div>
              <div class="bronze sponsor">Ian Rees</div>
              <div class="bronze sponsor">Ton Roosendaal</div>
              <div class="bronze sponsor">Lukas Alberts</div>
              <div class="bronze sponsor">Marius Grunca</div>
              <div class="bronze sponsor">Markus Vogt</div>
              <div class="bronze sponsor">Jose Alonso Mendoza</div>

          </div>
        </section>

    </div>

<?php include 'footer.php'; ?>
