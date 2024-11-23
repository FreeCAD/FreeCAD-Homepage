<?php
    $currentpage = "404.php";
    include("header.php");
?>

<script>
    function onClickArrow() {
        document.getElementById('belowArrow').scrollIntoView();
    }
</script>

  <main id="main" class="container-fluid">
    <section class="row section-cover d-flex align-items-center">
      <div class="col-lg-8">
        <img class="img-fluid" src="svg/WhatsThis.svg" alt="Error Photo"/>
      </div>

      <div class="col-lg-4 text-center text-lg-start align-content-center order-lg-first">
        <h1 class="home-title text-light mt-n5 mb-0 mt-lg-0">ERROR 404!</h1>
        <!-- displays the incorrect URL -->
        <h2 class="home-subtitle text-light mb-4"><?php echo $_SERVER['REQUEST_URI']; ?> does not exist, sorry.</h2>
        <div class="flex-column flex-lg-row">
          <a class="btn btn-light rounded-pill mt-2" role="button" href="/index.php"><?php echo _('Home'); ?></a>
          <a class="btn btn-outline-light rounded-pill mt-2" role="button" href="https://wiki.freecad.org/Release_notes_0.20"><?php echo _("See what's new"); ?></a>
        </div>
      </div>
    </section>

    <div class="d-flex justify-content-center "><img id="floating-arrow" src="svg/icon-down.svg" onClick="onClickArrow()" onmouseover="" style="cursor: pointer;"/></div>
    <a id="belowArrow"></a>
  <main>
<?php include 'footer.php'; ?>
