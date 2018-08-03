<?php
// idiot gettext cannot understand "en". it needs "en_GB"...
$localeMap = array(
    'en' => 'en_US',
    'fr' => 'fr_FR',
    'it' => 'it_IT',
    'ru' => 'ru_RU',
    'ja' => 'ja_JP',
    'af' => 'af_ZA',
    'hr' => 'hr_HR',
    'cs' => 'cs_CZ',
    'nl' => 'nl_NL',
    'fi' => 'fi_FI',
    'de' => 'de_DE',
    'hu' => 'hu_HU',
    'no' => 'no_NO',
    'pl' => 'pl_PL',
    'ro' => 'ro_RO',
    'sr' => 'sr_RS',
    'uk' => 'uk_UA',
    'el' => 'el_GR',
    'sk' => 'sk_SK',
    'tr' => 'tr_TR',
    'sl' => 'sl_SI',
);
$lang = "en";
if (isSet($_GET["lang"])) $lang = $_GET["lang"];
$locale = isset($localeMap[$lang]) ? $localeMap[$lang] : $lang;
putenv("LC_ALL=$locale");
setlocale(LC_ALL, $locale);
bindtextdomain("homepage", "lang");
textdomain("homepage");
bind_textdomain_codeset("homepage", 'UTF-8');
?>

<!DOCTYPE html>
<html lang="<?php echo $lang;?>" class="home">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale = 1">

	<title><?php echo _('FreeCAD: Your Own 3D Parametric Modeler'); ?></title>

	<!-- Include bootstrap CSS file -->
	<link rel="stylesheet" href="css/bootstrap-4.1.2.min.css">

	<!-- Custom Styles -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark navbar-custom">
		<a class="navbar-brand" href="#"><img src="svg/logo-freecad.svg"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse mr-auto" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a class="nav-link" href="https://www.freecadweb.org/wiki/Feature_list"><?php echo _('Features'); ?></a></li>
				<li class="nav-item"><a class="nav-link" href="https://www.freecadweb.org/wiki/Download"><?php echo _('Downloads'); ?></a></li>
				<li class="nav-item"><a class="nav-link" href="https://www.freecadweb.org/wiki/Getting_started"><?php echo _('Documentation'); ?></a></li>
				<li class="nav-item"><a class="nav-link" href="https://forum.freecadweb.org/"><?php echo _('Forum'); ?></a></li>
				<li class="nav-item"><a class="nav-link" href="https://github.com/FreeCAD/FreeCAD/"><?php echo _('Contribute'); ?>Contribute</a></li>
				<li class="nav-item"><a class="nav-link" href="https://www.freecadweb.org/wiki/Donate"><?php echo _('Donate'); ?></a></li>
				<li class="nav-item"><a class="nav-link" href="https://forum.freecadweb.org/viewforum.php?f=24"><?php echo _('Showcase'); ?></a></li>
			</ul>
            <ul class="navbar-nav ml-auto">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                        <img src="lang/<?php echo $lang; ?>/flag.jpg"/>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/?lang=af"><img src="lang/af/flag.jpg"/> <?php echo 'Afrikaans'; ?></a></li>
                        <li><a href="/?lang=zh_CN"><img src="lang/zh_CN/flag.jpg"/> <?php echo 'Chinese Simplified'; ?></a></li>
                        <li><a href="/?lang=zh_TW"><img src="lang/zh_TW/flag.jpg"/> <?php echo 'Chinese Traditional'; ?></a></li>
                        <li><a href="/?lang=hr"><img src="lang/hr/flag.jpg"/> <?php echo 'Croatian'; ?></a></li>
                        <li><a href="/?lang=cs"><img src="lang/cs/flag.jpg"/> <?php echo 'Czech'; ?></a></li>
                        <li><a href="/?lang=nl"><img src="lang/nl/flag.jpg"/> <?php echo 'Dutch'; ?></a></li>
                        <li><a href="/"><img src="lang/en/flag.jpg"/> <?php echo 'English'; ?></a></li>
                        <li><a href="/?lang=fi"><img src="lang/fi/flag.jpg"/> <?php echo 'Finnish'; ?></a></li>
                        <li><a href="/?lang=fr"><img src="lang/fr/flag.jpg"/> <?php echo 'French'; ?></a></li>
                        <li><a href="/?lang=de"><img src="lang/de/flag.jpg"/> <?php echo 'German'; ?></a></li>
                        <li><a href="/?lang=hu"><img src="lang/hu/flag.jpg"/> <?php echo 'Hungarian'; ?></a></li>
                        <li><a href="/?lang=ja"><img src="lang/ja/flag.jpg"/> <?php echo 'Japanese'; ?></a></li>
                        <li><a href="/?lang=no"><img src="lang/no/flag.jpg"/> <?php echo 'Norwegian'; ?></a></li>
                        <li><a href="/?lang=pl"><img src="lang/pl/flag.jpg"/> <?php echo 'Polish'; ?></a></li>
                        <li><a href="/?lang=pt_PT"><img src="lang/pt_PT/flag.jpg"/> <?php echo 'Portuguese'; ?></a></li>
                        <li><a href="/?lang=ro"><img src="lang/ro/flag.jpg"/> <?php echo 'Romanian'; ?></a></li>
                        <li><a href="/?lang=ru"><img src="lang/ru/flag.jpg"/> <?php echo 'Russian'; ?></a></li>
                        <li><a href="/?lang=sr"><img src="lang/sr/flag.jpg"/> <?php echo 'Serbian (Cyrillic)'; ?></a></li>
                        <li><a href="/?lang=es_ES"><img src="lang/es_ES/flag.jpg"/> <?php echo 'Spanish'; ?></a></li>
                        <li><a href="/?lang=sv_SE"><img src="lang/sv_SE/flag.jpg"/> <?php echo 'Swedish'; ?></a></li>
                        <li><a href="/?lang=uk"><img src="lang/uk/flag.jpg"/> <?php echo 'Ukrainian'; ?></a></li>
                        <li><a href="/?lang=it"><img src="lang/it/flag.jpg"/> <?php echo 'Italian'; ?></a></li>
                        <!-- <li><a href="/?lang=pt_BR"><img src="lang/pt_BR/flag.jpg"/> <?php echo 'Portuguese, Brazilian'; ?></a></li> -->
                        <li><a href="/?lang=el"><img src="lang/el/flag.jpg"/> <?php echo 'Greek'; ?></a></li>
                        <li><a href="/?lang=sk"><img src="lang/sk/flag.jpg"/> <?php echo 'Slovak'; ?></a></li>
                        <li><a href="/?lang=tr"><img src="lang/tr/flag.jpg"/> <?php echo 'Turkish'; ?></a></li>
                        <li><a href="/?lang=sl"><img src="lang/sl/flag.jpg"/> <?php echo 'Slovenian'; ?></a></li>
                    </ul>
                </li>
            </ul>
		</div>
	</nav>

	<div id="main" class="container-fluid">
		<div class="row section-cover vertical-align">
			<div class="col-lg-7">
				<h1 class="home-title"><?php echo _('FREECAD'); ?></h1>
				<h2 class="home-subtitle"><?php echo _('Your Own 3D Parametric Modeler'); ?></h2>
				<a class="btn btn-default download" href="https://www.freecadweb.org/wiki/Download" role="button">
					<div class="main"><?php echo _('Download'); ?></div>
					<div class="opt"><?php echo _('0.17'); ?></div>
				</a>
			</div>

			<div class="col-lg-5 d-none d-lg-block">
				<img class="img-fluid" src="images/cover-photo.png" alt="Cover Photo">
			</div>

			<div id="floating-arrow" class="d-none d-lg-block">
				<img src="svg/icon-down.svg">
			</div>
		</div>

		<div id="section_first" class="row section vertical-align">
			<div class="col-lg-8">
				<img class="img-fluid screenshot" src="images/screenshot-01.jpg" alt="Screenshot 1">
			</div>

			<!-- This div appears only on desktop and larger screens -->
			<div class="col-lg-4 d-none d-lg-block">
				<h3 class="section-title"><?php echo _('Freedom to build what you want'); ?></h3>
				<p class="section-paragraph">
                    <?php echo _('FreeCAD is an open-source parametric 3D modeler made primarily to design real-life objects of any size. Parametric modeling allows you to easily modify your design by going back into your model history and changing its parameters.'); ?>
				</p>
			</div>

			<!-- This div appears only on mobile devices -->
			<div class="col-lg-4 d-lg-none section-mobile">
                <h3 class="section-title"><?php echo _('Freedom to build what you want'); ?></h3>
				<p class="section-paragraph">
                    <?php echo _('FreeCAD is an open-source parametric 3D modeler made primarily to design real-life objects of any size. Parametric modeling allows you to easily modify your design by going back into your model history and changing its parameters.'); ?>
				</p>
			</div>
		</div>

		<div class="row section vertical-align">
			<!-- This div appears only on desktop and larger screens -->
			<div class="col-lg-4 d-none d-lg-block">
				<h3 class="section-title"><?php echo _('Create 3D from 2D & back'); ?></h3>
				<p class="section-paragraph">
                    <?php echo _('FreeCAD allows you to sketch geometry constrained 2D shapes and use them as a base to build other objects. It contains many components to adjust dimensions or extract design details from 3D models to create high quality production ready drawings.'); ?>
				</p>
			</div>

			<div class="col-lg-8">
				<img class="img-fluid screenshot" src="images/screenshot-02.jpg" alt="Screenshot 2">
			</div>

			<!-- This div appears only on mobile devices -->
			<div class="col-lg-4 d-lg-none section-mobile">
                <h3 class="section-title"><?php echo _('Create 3D from 2D & back'); ?></h3>
				<p class="section-paragraph">
                    <?php echo _('FreeCAD allows you to sketch geometry constrained 2D shapes and use them as a base to build other objects. It contains many components to adjust dimensions or extract design details from 3D models to create high quality production ready drawings.'); ?>
				</p>
			</div>
		</div>

		<div class="row section vertical-align">
			<div class="col-lg-8">
				<img class="img-fluid screenshot" src="images/screenshot-03-1.png" alt="Screenshot 3">
			</div>

			<!-- This div appears only on desktop and larger screens -->
			<div class="col-lg-4 d-none d-lg-block">
				<h3 class="section-title"><?php echo _('Accessible, flexible & integrated'); ?></h3>
				<p class="section-paragraph">
                    <?php echo _('FreeCAD is a multiplatfom (Windows, Mac and Linux), highly customizable and extensible software. It reads and writes to many open file formats such as STEP, IGES, STL, SVG, DXF, OBJ, IFC, DAE and many others, making it possible to seamlessly integrate it into your workflow.'); ?>
				</p>
			</div>

			<!-- This div appears only on mobile devices -->
			<div class="col-lg-4 d-lg-none section-mobile">
                <h3 class="section-title"><?php echo _('Accessible, flexible & integrated'); ?></h3>
				<p class="section-paragraph">
                    <?php echo _('FreeCAD is a multiplatfom (Windows, Mac and Linux), highly customizable and extensible software. It reads and writes to many open file formats such as STEP, IGES, STL, SVG, DXF, OBJ, IFC, DAE and many others, making it possible to seamlessly integrate it into your workflow.'); ?>
				</p>
			</div>
		</div>

		<div class="row section vertical-align">
			<!-- This div appears only on desktop and larger screens -->
			<div class="col-lg-4 d-none d-lg-block">
				<h3 class="section-title"><?php echo _('Designed for your needs'); ?></h3>
				<p class="section-paragraph">
                    <?php echo _('FreeCAD is designed to fit a wide range of uses including product design, mechanical engineering and architecture. Whether you are a hobbyist, a programmer, an experienced CAD user, a student or a teacher, you will feel right at home with FreeCAD.'); ?>
				</p>
			</div>

			<div class="col-lg-8">
				<img class="img-fluid screenshot" src="images/screenshot-04.jpg" alt="Screenshot 4">
			</div>

			<!-- This div appears only on mobile devices -->
			<div class="col-lg-4 d-lg-none section-mobile">
                <h3 class="section-title"><?php echo _('Designed for your needs'); ?></h3>
				<p class="section-paragraph">
                    <?php echo _('FreeCAD is designed to fit a wide range of uses including product design, mechanical engineering and architecture. Whether you are a hobbyist, a programmer, an experienced CAD user, a student or a teacher, you will feel right at home with FreeCAD.'); ?>
				</p>
			</div>
		</div>

		<div class="row section vertical-align">
			<div class="col-lg-8">
				<img class="img-fluid screenshot" src="images/screenshot-05.jpg" alt="Screenshot 5">
			</div>

			<!-- This div appears only on desktop and larger screens -->
			<div class="col-lg-4 d-none d-lg-block">
				<h3 class="section-title"><?php echo _('And many more great features'); ?></h3>
				<p class="section-paragraph">
                    <?php echo _('FreeCAD equips you with all the right tools for your needs. You get modern Finite Element Analysis (FEA) tools, experimental CFD, BIM, Geodata workbenches, Path workbench, a robot simulation module that allows you to study robot movements and many more features. FreeCAD really is a Swiss Army knife of general-purpose engineering toolkits.'); ?>
				</p>
				<a class="btn btn-default btn-lg section-button" role="button" href="https://www.freecadweb.org/wiki/Feature_list#General_features:"><?php echo _('Learn more'); ?></a>
			</div>

			<!-- This div appears only on mobile devices -->
			<div class="col-lg-4 d-lg-none section-mobile">
                <h3 class="section-title"><?php echo _('And many more great features'); ?></h3>
				<p class="section-paragraph">
                    <?php echo _('FreeCAD equips you with all the right tools for your needs. You get modern Finite Element Analysis (FEA) tools, experimental CFD, BIM, Geodata workbenches, Path workbench, a robot simulation module that allows you to study robot movements and many more features. FreeCAD really is a Swiss Army knife of general-purpose engineering toolkits.'); ?>
				</p>
				<a class="btn btn-default btn-lg section-button" role="button" href="https://www.freecadweb.org/wiki/Feature_list#General_features:"><?php echo _('Learn more'); ?></a>
			</div>
		</div>

		<div class="row section vertical-align">
			<!-- This div appears only on desktop and larger screens -->
			<div class="col-lg-4 d-none d-lg-block">
				<h3 class="section-title"><?php echo _('Want to contribute to FreeCAD?'); ?></h3>
				<p class="section-paragraph">
                    <?php echo _('FreeCAD is a truly open source project and if you would like to help fix bugs, implement new cool features or work on the documentation, we invite you to join us and create a software that benefits the whole community.'); ?>
				</p>
				<a class="btn btn-default btn-lg section-button" role="button" href="https://github.com/FreeCAD/FreeCAD/"><?php echo _('Get involved'); ?></a>
			</div>

			<div class="col-lg-8">
				<img class="img-fluid screenshot" src="images/screenshot-06.jpg" alt="Screenshot 6">
			</div>

			<!-- This div appears only on mobile devices -->
			<div class="col-lg-4 d-lg-none section-mobile">
                <h3 class="section-title"><?php echo _('Want to contribute to FreeCAD?'); ?></h3>
				<p class="section-paragraph">
                    <?php echo _('FreeCAD is a truly open source project and if you would like to help fix bugs, implement new cool features or work on the documentation, we invite you to join us and create a software that benefits the whole community.'); ?>
				</p>
				<a class="btn btn-default btn-lg section-button" role="button" href="https://github.com/FreeCAD/FreeCAD/"><?php echo _('Get involved'); ?></a>
			</div>
		</div>
	</div>

	<footer class="container-fluid footer-custom">
		<div class="row">
			<div class="col-lg-3 col-sm-6 footer-links">
				<h6><?php echo _('Community'); ?></h6>
				<ul>
					<li><a href="https://github.com/FreeCAD/FreeCAD">Github</a></li>
					<li><a href="https://www.facebook.com/FreeCAD">Facebook</a></li>
					<li><a href="https://plus.google.com/u/0/communities/103183769032333474646">Google+</a></li>
				</ul>
			</div>

			<div class="col-lg-3 col-sm-6 footer-links">
				<h6>Learn</h6>
				<ul>
					<li><a href="https://www.freecadweb.org/wiki/Tutorials"><?php echo _('Tutorials'); ?></a></li>
					<li><a href="https://www.youtube.com/results?search_query=freecad"><?php echo _('Youtube Videos'); ?></a></li>
					<li><a href="http://area51.stackexchange.com/proposals/88434/freecad">Stack Exchange</a></li>
				</ul>
			</div>

			<div class="col-lg-3 col-sm-6 footer-links">
				<h6><?php echo _('Contribute'); ?></h6>
				<ul>
					<li><a href="https://www.freecadweb.org/wiki/Help_FreeCAD"><?php echo _('How can I help?'); ?></a></li>
					<li><a href="https://www.freecadweb.org/wiki/Donate"><?php echo _('Donate'); ?></a></li>
					<li><a href="https://crowdin.com/project/freecad"><?php echo _('Translate'); ?></a></li>
				</ul>
			</div>

			<div class="col-lg-3 col-sm-6 footer-links">
				<h6><?php echo _('Code'); ?></h6>
				<ul>
					<li><a  href="https://www.freecadweb.org/wiki/Compiling"><?php echo _('Building from source'); ?></a></li>
					<li><a href="https://www.freecadweb.org/api/"><?php echo _('C++ & Python API'); ?></a></li>
					<li><a href="https://www.freecadweb.org/wiki/Licence"><?php echo _('License information'); ?></a></li>
				</ul>
			</div>
		</div>

		<span>
            <?php echo _('© The FreeCAD Team, 2018. Image Credits (Top to bottom): ppemawm, r-frank, epileftric, regis, rider_mortagnais, bejant'); ?>
		</span>
	</footer>

	<!-- Include Bootstrap JS files -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper-1.14.3.min.js"></script>
	<script src="js/bootstrap-4.1.2.min.js"></script>
</body>
</html>
