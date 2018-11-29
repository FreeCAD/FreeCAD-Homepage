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

	<title><?php echo _('FreeCAD: Select Your Platform'); ?></title>
	<link rel="shortcut icon" href="images/favicon.ico">

	<!-- Include bootstrap CSS file -->
	<link rel="stylesheet" href="css/bootstrap-4.1.2.min.css">

	<!-- Custom Styles -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark navbar-custom">

		<a class="navbar-brand" href="index.php">
			<img class="img-fluid" src="svg/logo-freecad.svg">
		</a>

		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="nav nav-pills ml-auto">
				<li class="nav-item"><a class="nav-link" href="https://www.freecadweb.org/wiki/Feature_list"><?php echo _('Features'); ?></a></li>
				<li class="nav-item"><a class="nav-link active" href="downloads.php"><?php echo _('Downloads'); ?></a></li>
				<li class="nav-item"><a class="nav-link" href="https://www.freecadweb.org/wiki/Getting_started"><?php echo _('Documentation'); ?></a></li>
				<li class="nav-item"><a class="nav-link" href="https://forum.freecadweb.org/"><?php echo _('Forum'); ?></a></li>
				<li class="nav-item"><a class="nav-link" href="https://github.com/FreeCAD/FreeCAD/"><?php echo _('Contribute'); ?></a></li>
				<li class="nav-item"><a class="nav-link" href="https://www.freecadweb.org/wiki/Donate"><?php echo _('Donate'); ?></a></li>
				<li class="nav-item"><a class="nav-link" href="https://forum.freecadweb.org/viewforum.php?f=24"><?php echo _('Showcase'); ?></a></li>
				<li class="nav-item dropdown ml-auto">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" 
					aria-haspopup="true" aria-expanded="false">
						<img src="lang/<?php echo $lang; ?>/flag.jpg"/>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="/?lang=af"><img src="lang/af/flag.jpg"/><?php echo _('Afrikaans'); ?></a>
						<a class="dropdown-item" href="/?lang=zh_CN"><img src="lang/zh_CN/flag.jpg"/><?php echo _('Chinese Simplified'); ?></a>
						<a class="dropdown-item" href="/?lang=zh_TW"><img src="lang/zh_TW/flag.jpg"/><?php echo _('Chinese Traditional'); ?></a>
						<a class="dropdown-item" href="/?lang=hr"><img src="lang/hr/flag.jpg"/><?php echo _('Croatian'); ?></a>
						<a class="dropdown-item" href="/?lang=cs"><img src="lang/cs/flag.jpg"/><?php echo _('Czech'); ?></a>
						<a class="dropdown-item" href="/?lang=nl"><img src="lang/nl/flag.jpg"/><?php echo _('Dutch'); ?></a>
						<a class="dropdown-item" href="/"><img src="lang/en/flag.jpg"/><?php echo _('English'); ?></a>
						<a class="dropdown-item" href="/?lang=fi"><img src="lang/fi/flag.jpg"/><?php echo _('Finnish'); ?></a>
						<a class="dropdown-item" href="/?lang=fr"><img src="lang/fr/flag.jpg"/><?php echo _('French'); ?></a>
						<a class="dropdown-item" href="/?lang=de"><img src="lang/de/flag.jpg"/><?php echo _('German'); ?></a>
						<a class="dropdown-item" href="/?lang=hu"><img src="lang/hu/flag.jpg"/><?php echo _('Hungarian'); ?></a>
						<a class="dropdown-item" href="/?lang=ja"><img src="lang/ja/flag.jpg"/><?php echo _('Japanese'); ?></a>
						<a class="dropdown-item" href="/?lang=no"><img src="lang/no/flag.jpg"/><?php echo _('Norwegian'); ?></a>
						<a class="dropdown-item" href="/?lang=pl"><img src="lang/pl/flag.jpg"/><?php echo _('Polish'); ?></a>
						<a class="dropdown-item" href="/?lang=pt_PT"><img src="lang/pt_PT/flag.jpg"/><?php echo _('Portuguese'); ?></a>
						<a class="dropdown-item" href="/?lang=ro"><img src="lang/ro/flag.jpg"/><?php echo _('Romanian'); ?></a>
						<a class="dropdown-item" href="/?lang=ru"><img src="lang/ru/flag.jpg"/><?php echo _('Russian'); ?></a>
						<a class="dropdown-item" href="/?lang=sr"><img src="lang/sr/flag.jpg"/><?php echo _('Serbian (Cyrillic)'); ?></a>
						<a class="dropdown-item" href="/?lang=es_ES"><img src="lang/es_ES/flag.jpg"/><?php echo _('Spanish'); ?></a>
						<a class="dropdown-item" href="/?lang=sv_SE"><img src="lang/sv_SE/flag.jpg"/><?php echo _('Swedish'); ?></a>
						<a class="dropdown-item" href="/?lang=uk"><img src="lang/uk/flag.jpg"/><?php echo _('Ukrainian'); ?></a>
						<a class="dropdown-item" href="/?lang=it"><img src="lang/it/flag.jpg"/><?php echo _('Italian'); ?></a>
						<!-- <a class="dropdown-item" href="/?lang=pt_BR"><img src="lang/pt_BR/flag.jpg"/>Portuguese, Brazilian</a> -->
						<a class="dropdown-item" href="/?lang=el"><img src="lang/el/flag.jpg"/><?php echo _('Greek'); ?></a>
						<a class="dropdown-item" href="/?lang=sk"><img src="lang/sk/flag.jpg"/><?php echo _('Slovak'); ?></a>
						<a class="dropdown-item" href="/?lang=tr"><img src="lang/tr/flag.jpg"/><?php echo _('Turkish'); ?></a>
						<a class="dropdown-item" href="/?lang=sl"><img src="lang/sl/flag.jpg"/><?php echo _('Slovenian'); ?></a>
					</div>
				</li>
			</ul>
		</div>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

	</nav>

	<div id="main" class="container-fluid">
		<div class="allign-text-center">
			<h2 class="downloads-select-platform"><?php echo _('Current stable version: 0.17'); ?></h2>
			<p class="platform-select-text"><?php echo _('Select your desired platform'); ?></p>
		</div>
		
		<div class="row justify-content-around">

			<div class="col-lg-3 col-sm-4 platform-card">
				<img class="img-fluid platform-icon w-100" src="svg/icon-windows.svg" alt="Windows Downloads">
				<span class="platform-name">Windows</span>
				
				<div class="btn-group w-100" role="group" aria-label="platform-type">
					<a class="btn btn-default w-100 platform-download-btn border-right" role="button" 
					href="https://github.com/FreeCAD/FreeCAD/releases/download/0.17/FreeCAD-0.17.13528.5c3f7bf-WIN-x86-installer.exe">
						32-Bit
					</a>
					<a class="btn btn-default w-100 platform-download-btn border-left" role="button" 
					href="https://github.com/FreeCAD/FreeCAD/releases/download/0.17/FreeCAD-0.17.13541.9948ee4-WIN-x64-installer.exe">
						64-Bit
					</a>
				</div>
			</div>

			<div class="col-lg-3 col-sm-4 platform-card">
				<img class="img-fluid platform-icon w-100" src="svg/icon-apple.svg" alt="Mac Downloads">
				<span class="platform-name">Mac</span>
				<a class="btn btn-default w-100 platform-download-btn btn-red" role="button" 
				href="https://github.com/FreeCAD/FreeCAD/releases/download/0.17/FreeCAD_0.17-13541.9948ee4-OSX-x86_64-Qt5.dmg">
					64-Bit
				</a>
			</div>
			
			<div class="col-lg-3 col-sm-4 platform-card">
				<img class="img-fluid platform-icon w-100" src="svg/icon-linux.svg" alt="Linux Downloads">
				<span class="platform-name">Linux</span>
				<a class="btn btn-default w-100 platform-download-btn btn-red" role="button" 
				href="https://github.com/FreeCAD/FreeCAD/releases/download/0.17/FreeCAD-0.17.13541.9948ee4.glibc2.17-x86_64.AppImage">
					64-Bit AppImage
				</a>
			</div>
		</div>
		
		<div class="download-notes">
			<h6><?php echo _('Notes'); ?></h6>
			<p>
				<?php echo _('Please note that FreeCAD has still not reached a version 1.0 status 
				in our view, and might not be ready for production use. Nevertheless multitudes of 
				users use it. To find out if FreeCAD is appropriate for your project, please check 
				out the '); ?>
				<a href="https://forum.freecadweb.org/">
					<?php echo _('FreeCAD forum.'); ?>
				</a>
			</p>
			<p>
				<?php echo _("The first 0.17 release of FreeCAD (0.17.13509) was published 
				on 2018-04-06. Many bug fix releases have been published since then, the latest bug 
				fix release 0.17.13541 was published on 2018-08-16. It might not be available to all 
				operating systems at this time. To find out what's new, see the "); ?>
				<a href="https://www.freecadweb.org/wiki/Release_notes_0.17">
					<?php echo _('release notes.'); ?>
				</a>
			</p>
			<p>
				<?php echo _('You will find SHA256 checksums (to verify integrity of your download) 
				and Windows portable versions on the '); ?>
				<a href="https://github.com/FreeCAD/FreeCAD/releases/tag/0.17">
					<?php echo _('0.17 Release page on GitHub'); ?>
				</a>
				<?php echo _(' (Older portable builds have been pruned. Availability will return in 
				the future).'); ?>
			</p>

			<h6><?php echo _('Notes for Windows users'); ?></h6>
			<ul>
				<li><?php echo _('The 32-Bit installer (x86) supports the following versions of 
				Windows: 7/8/10.'); ?></li>
				<li><?php echo _('The 64-Bit installer (x64) supports the following versions of 
				Windows: 7/8/10.'); ?></li>
			</ul>
			
			<h6><?php echo _('Notes for Mac OS X users'); ?></h6>
			<p><?php echo _('Mac OS X 10.11 El Capitan is the minimum supported version.'); ?></p>
			
			<h6><?php echo _('Notes for GNU/Linux users'); ?></h6>
			<p>
				<?php echo _('FreeCAD can be installed from most Linux distributions official 
				repositories, but the version they provide might be quite dated and be missing 
				many features. Instead you can download the linked AppImage above, mark it as 
				executable and launch it without installation. Please see the '); ?>
				<a href="https://www.freecadweb.org/wiki/Install_on_Unix">
					<?php echo _('Install on Unix'); ?>
				</a>
				<?php echo _(' page for more installation options, including how to get up-to-date 
				packages for Ubuntu and derivatives.'); ?>
			</p>					
			
			<h6><?php echo _('Development Versions'); ?></h6>
			<p>
				<?php echo _("FreeCAD's development is always active! Do you want to check 
				out the 0.18 development release? For MacOS, Windows, Linux (AppImage) and 
				source code, see the "); ?>
				<a href="https://github.com/FreeCAD/FreeCAD/releases"><?php echo _('FreeCAD 
				releases page.'); ?></a>
			</p>			
			
			<h6><?php echo _('Additional Modules and Macros'); ?></h6>
			<p>
				<?php echo _('The FreeCAD community provides a wealth of additional modules 
				and macros. They can now easily be installed directly from within FreeCAD 
				using the '); ?>
				<a href="https://www.freecadweb.org/wiki/AddonManager"><?php echo _('Addon manager.'); ?></a>
			</p>
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
					<li><a href="https://stackexchange.com/search?q=freecad">Stack Exchange</a></li>
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
			<?php echo _('© The FreeCAD Team. Homepage Image Credits (Top to bottom): 
			ppemawm, r-frank, epileftric, regis, rider_mortagnais, bejant. 
			Homepage design by AR795.'); ?>
		</span>
	</footer>

	<!-- Include Bootstrap JS files -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper-1.14.3.min.js"></script>
	<script src="js/bootstrap-4.1.2.min.js"></script>
</body>
</html>