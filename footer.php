
    <!-- ------ -->
    <!-- FOOTER -->
    <!-- ------ -->

  <footer class="container-fluid footer-custom bg-dark text-center text-light">

    <div class="justify-content-center my-3 my-md-5">
      <?php echo _('Get in touch!'); ?><br/>
      <a href="https://forum.freecad.org/"><img class="icon-social m-2" src="svg/icon-forum-light.svg" alt="Forum"/></a>
      <a href="https://github.com/FreeCAD/FreeCAD"><img class="icon-social m-2" src="svg/icon-github-light.svg" alt="GitHub"/></a>
      <a href="https://fosstodon.org/@FreeCAD" rel="me"><img class="icon-social m-2" src="svg/icon-mastodon-light.svg" alt="Mastodon"/></a>
      <a href="https://matrix.to/#/#FreeCAD_FreeCAD:gitter.im"><img class="icon-social m-2" src="svg/icon-matrix-light.svg" alt="Matrix"/></a>
      <a href="irc://irc.libera.chat/freecad"><img class="icon-social m-2" src="svg/icon-irc-light.svg" alt="IRC" /></a>
      <a href="https://gitter.im/FreeCAD/FreeCAD"><img class="icon-social m-2" src="svg/icon-gitter-light.svg" alt="Gitter.im"/></a>
      <a href="https://discord.gg/w2cTKGzccC"><img class="icon-social m-2" src="svg/icon-discord-light.svg" alt="Discord"/></a>
      <a href="https://www.reddit.com/r/freecad"><img class="icon-social m-2" src="svg/icon-reddit-light.svg" alt="Reddit"/></a>
      <a href="https://twitter.com/FreeCADNews"><img class="icon-social m-2" src="svg/icon-twitter-light.svg" alt="Twitter"/></a>
      <a href="https://www.facebook.com/FreeCAD"><img class="icon-social m-2" src="svg/icon-facebook-light.svg" alt="Facebook"/></a>
      <a href="https://www.linkedin.com/groups/4295230"><img class="icon-social m-2" src="svg/icon-linkedin-light.svg" alt="LinkedIn"/></a>
    </div>

    <p class="footer-credits mt-3">
      <?php echo _('© The FreeCAD Team. Homepage image credits (top to bottom): ppemawm,
      r-frank, epileftric, regis, rider_mortagnais, bejant.'); ?>
    </p>

    <p><?php echo _('This project is supported by:'); ?>
      <a href="https://www.digitalocean.com/?utm_medium=opensource&utm_source=FreeCAD">
        <img src="https://opensource.nyc3.cdn.digitaloceanspaces.com/attribution/assets/SVG/DO_Logo_horizontal_blue.svg" width="180px">
      </a>
      ,
      <a href="https://www.kipro-pcb.com/">
          KiCad Services Corp.
      </a>
      <?php echo _('and'); ?>
      <a href="<?php echo $sponsorurl; ?>"><?php echo _('other sponsors'); ?></a>
    </p>

    <div class="float-sm-end">
    <a id="githubLink" href="#"><img class="icon-social m-3" src="svg/icon-github-light.svg" alt="GitHub" /><?php echo _('Improve this
      page on GitHub'); ?></a>
    <?php
      $currentUrl = $_SERVER['REQUEST_URI'];
      $githubEditUrl = 'https://github.com/FreeCAD/FreeCAD-Homepage/blob/master/' . $currentpage;
      echo '<script>document.getElementById("githubLink").setAttribute("href", "' . $githubEditUrl . '");</script>';
      ?>
    </div>

  </footer>

  <!-- Include Bootstrap JS files -->
  <script src="js/bootstrap-5.3.3.bundle.min.js"></script>

</body>
</html>
