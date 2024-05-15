<?php
    $currentpage = "privacy.php";
    include("header.php");
    include('./contrib/Parsedown.php');
    $Parsedown = new Parsedown();
    $giturl = "https://github.com/FreeCAD/FreeCAD/blob/master/";
    $rawurl = "https://raw.githubusercontent.com/FreeCAD/FreeCAD/master/";
    $gitpage = "PRIVACY_POLICY.md";
?>

    <div id="main" class="container-fluid whitelinks md">

<?php
    $text = file_get_contents($rawurl.$gitpage);
    echo $Parsedown->text($text);
?>

        <p>
            <?php echo _("This page is retrieved from"); ?>
            <a href="<?php echo $giturl.$gitpage; ?>"><?php echo $giturl.$gitpage; ?></a>
        </p>
    </div>

<?php
    include 'footer.php';
?>
