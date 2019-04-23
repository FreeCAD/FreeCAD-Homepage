<?php include("translation.php"); ?>

<!DOCTYPE html>
<html lang="<?php echo $lang;?>" class="home">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale = 1">
	<meta name="description" content="FreeCAD, the open source parametric modeler">
	<meta name="keywords" content="FreeCAD, Open Source, Parametric Modeler, CAD">
	
	<title><?php echo _('FreeCAD: Your Own 3D Parametric Modeler'); ?></title>
	<link rel="shortcut icon" href="images/favicon.ico">
	
	<!-- Include bootstrap CSS file -->
	<link rel="stylesheet" href="css/bootstrap-4.3.1.min.css"/>
	
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
				<li class="nav-item">
					<a class="nav-link" href="https://www.freecadweb.org/wiki/Feature_list">
						<?php echo _('Features'); ?>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="<?php getTranslatedDownloadLink(); ?>">
						<?php echo _('Downloads'); ?>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="https://www.freecadweb.org/wiki/Getting_started">
						<?php echo _('Documentation'); ?>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="https://forum.freecadweb.org/">
						<?php echo _('Forum'); ?>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="https://github.com/FreeCAD/FreeCAD/">
						<?php echo _('Contribute'); ?>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="https://www.freecadweb.org/wiki/Donate">
						<?php echo _('Donate'); ?>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="https://forum.freecadweb.org/viewforum.php?f=24">
						<?php echo _('Showcase'); ?>
					</a>
				</li>

				<li class="nav-item dropdown ml-auto">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" 
					role="button" aria-haspopup="true" aria-expanded="false">
						<img src="lang/<?php echo $lang; ?>/flag.jpg"/>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
<?php echo getFlags("/"); ?>
					</div>
				</li>
			</ul>
		</div>

		<button class="navbar-toggler" type="button" data-toggle="collapse" 
		data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
		aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	</nav>

	<div id="main" class="container-fluid">
		<div class="row section-cover vertical-align">
			<div class="col-lg-7">
				<h1 class="home-title"><?php echo _('FreeCAD'); ?></h1>

				<h2 class="home-subtitle"><?php echo _('Your Own 3D Parametric Modeler'); ?></h2>

				<a class="btn btn-default btn-download" role="button" href="downloads.php">
					<div class="btn-download-left"><?php echo _('Download'); ?></div>

					<div class="btn-download-right"><?php echo _('0.17'); ?></div>
				</a>

				<a id="btn-features" href="https://www.youtube.com/watch?v=7iLOaL9z59k">
					<?php echo _("See what's new"); ?>
				</a>
			</div>

			<div class="col-lg-5 d-none d-lg-block">
				<img class="img-fluid" src="images/cover-photo.png" alt="Cover Photo">
			</div>

			<div id="floating-arrow" class="d-none d-lg-block">
				<img src="svg/icon-down.svg">
			</div>
		</div>

		<div id="section_first" class="row justify-content-around section vertical-align">
			<div class="col-lg-7">
				<img class="img-fluid screenshot" src="images/screenshot-01.jpg" 
				alt="Screenshot 1">
			</div>

			<!-- This div appears only on desktop and larger screens -->
			<div class="col-lg-4 d-none d-lg-block">
				<h3 class="section-title"><?php echo _('Freedom to build what you want'); ?></h3>

				<p class="section-paragraph">
					<?php echo _('FreeCAD is an open-source parametric 3D modeler made primarily 
					to design real-life objects of any size. Parametric modeling allows you to 
					easily modify your design by going back into your model history and changing 
					its parameters.'); ?>
				</p>
			</div>

			<!-- This div appears only on mobile devices -->
			<div class="col-lg-4 d-lg-none section-mobile">
				<h3 class="section-title"><?php echo _('Freedom to build what you want'); ?></h3>

				<p class="section-paragraph">
					<?php echo _('FreeCAD is an open-source parametric 3D modeler made primarily 
					to design real-life objects of any size. Parametric modeling allows you to 
					easily modify your design by going back into your model history and changing 
					its parameters.'); ?>
				</p>
			</div>
		</div>

		<div class="row justify-content-around section vertical-align">
			<!-- This div appears only on desktop and larger screens -->
			<div class="col-lg-4 d-none d-lg-block">
				<h3 class="section-title"><?php echo _('Create 3D from 2D & back'); ?></h3>

				<p class="section-paragraph">
					<?php echo _('FreeCAD allows you to sketch geometry constrained 2D shapes and 
					use them as a base to build other objects. It contains many components to 
					adjust dimensions or extract design details from 3D models to create high 
					quality production ready drawings.'); ?>
				</p>
			</div>

			<div class="col-lg-7">
				<img class="img-fluid screenshot" src="images/screenshot-02.jpg" 
				alt="Screenshot 2">
			</div>

			<!-- This div appears only on mobile devices -->
			<div class="col-lg-4 d-lg-none section-mobile">
				<h3 class="section-title"><?php echo _('Create 3D from 2D & back'); ?></h3>

				<p class="section-paragraph">
					<?php echo _('FreeCAD allows you to sketch geometry constrained 2D shapes and 
					use them as a base to build other objects. It contains many components to 
					adjust dimensions or extract design details from 3D models to create high 
					quality production ready drawings.'); ?>
				</p>
			</div>
		</div>

		<div class="row justify-content-around section vertical-align">
			<div class="col-lg-7">
				<img class="img-fluid screenshot" src="images/screenshot-03.jpg" 
				alt="Screenshot 3">
			</div>

			<!-- This div appears only on desktop and larger screens -->
			<div class="col-lg-4 d-none d-lg-block">
				<h3 class="section-title"><?php echo _('Accessible, flexible & integrated'); ?></h3>

				<p class="section-paragraph">
					<?php echo _('FreeCAD is a multiplatfom (Windows, Mac and Linux), highly 
					customizable and extensible software. It reads and writes to many open 
					file formats such as STEP, IGES, STL, SVG, DXF, OBJ, IFC, DAE and many 
					others, making it possible to seamlessly integrate it into your workflow.'); ?>
				</p>
			</div>

			<!-- This div appears only on mobile devices -->
			<div class="col-lg-4 d-lg-none section-mobile">
				<h3 class="section-title"><?php echo _('Accessible, flexible & integrated'); ?></h3>

				<p class="section-paragraph">
					<?php echo _('FreeCAD is a multiplatfom (Windows, Mac and Linux), highly 
					customizable and extensible software. It reads and writes to many open 
					file formats such as STEP, IGES, STL, SVG, DXF, OBJ, IFC, DAE and many 
					others, making it possible to seamlessly integrate it into your workflow.'); ?>
				</p>
			</div>
		</div>

		<div class="row justify-content-around section vertical-align">
			<!-- This div appears only on desktop and larger screens -->
			<div class="col-lg-4 d-none d-lg-block">
				<h3 class="section-title"><?php echo _('Designed for your needs'); ?></h3>

				<p class="section-paragraph">
					<?php echo _('FreeCAD is designed to fit a wide range of uses including 
					product design, mechanical engineering and architecture. Whether you 
					are a hobbyist, a programmer, an experienced CAD user, a student or 
					a teacher, you will feel right at home with FreeCAD.'); ?>
				</p>
			</div>

			<div class="col-lg-7">
				<img class="img-fluid screenshot" src="images/screenshot-04.jpg" 
				alt="Screenshot 4">
			</div>

			<!-- This div appears only on mobile devices -->
			<div class="col-lg-4 d-lg-none section-mobile">
				<h3 class="section-title"><?php echo _('Designed for your needs'); ?></h3>

				<p class="section-paragraph">
					<?php echo _('FreeCAD is designed to fit a wide range of uses including 
					product design, mechanical engineering and architecture. Whether you 
					are a hobbyist, a programmer, an experienced CAD user, a student or 
					a teacher, you will feel right at home with FreeCAD.'); ?>
				</p>
			</div>
		</div>

		<div class="row justify-content-around section vertical-align">
			<div class="col-lg-7">
				<img class="img-fluid screenshot" src="images/screenshot-05.jpg" 
				alt="Screenshot 5">
			</div>

			<!-- This div appears only on desktop and larger screens -->
			<div class="col-lg-4 d-none d-lg-block">
				<h3 class="section-title"><?php echo _('And many more great features'); ?></h3>

				<p class="section-paragraph">
					<?php echo _('FreeCAD equips you with all the right tools for your needs. 
					You get modern Finite Element Analysis (FEA) tools, experimental CFD, 
					BIM, Geodata workbenches, Path workbench, a robot simulation module that 
					allows you to study robot movements and many more features. FreeCAD 
					really is a Swiss Army knife of general-purpose engineering toolkits.'); ?>
				</p>

				<a class="btn btn-default btn-lg section-button" role="button" 
				href="https://www.freecadweb.org/wiki/Feature_list#General_features:">
					<?php echo _('Learn more'); ?>
				</a>
			</div>

			<!-- This div appears only on mobile devices -->
			<div class="col-lg-4 d-lg-none section-mobile">
				<h3 class="section-title"><?php echo _('And many more great features'); ?></h3>

				<p class="section-paragraph">
					<?php echo _('FreeCAD equips you with all the right tools for your needs. 
					You get modern Finite Element Analysis (FEA) tools, experimental CFD, 
					BIM, Geodata workbenches, Path workbench, a robot simulation module that 
					allows you to study robot movements and many more features. FreeCAD 
					really is a Swiss Army knife of general-purpose engineering toolkits.'); ?>
				</p>

				<a class="btn btn-default btn-lg section-button" role="button" 
				href="https://www.freecadweb.org/wiki/Feature_list#General_features:">
					<?php echo _('Learn more'); ?>
				</a>
			</div>
		</div>

		<div class="row justify-content-around section vertical-align">
			<!-- This div appears only on desktop and larger screens -->
			<div class="col-lg-4 d-none d-lg-block">
				<h3 class="section-title"><?php echo _('Want to contribute to FreeCAD?'); ?></h3>

				<p class="section-paragraph">
					<?php echo _('FreeCAD is a truly open source project and if you would 
					like to help fix bugs, implement new cool features or work on the 
					documentation, we invite you to join us and create a software that 
					benefits the whole community.'); ?>
				</p>

				<a class="btn btn-default btn-lg section-button" role="button" 
				href="https://github.com/FreeCAD/FreeCAD/">
					<?php echo _('Get involved'); ?>
				</a>
			</div>

			<div class="col-lg-7">
				<img class="img-fluid screenshot" src="images/screenshot-06.jpg" 
				alt="Screenshot 6">
			</div>

			<!-- This div appears only on mobile devices -->
			<div class="col-lg-4 d-lg-none section-mobile">
				<h3 class="section-title"><?php echo _('Want to contribute to FreeCAD?'); ?></h3>

				<p class="section-paragraph">
					<?php echo _('FreeCAD is a truly open source project and if you would 
					like to help fix bugs, implement new cool features or work on the 
					documentation, we invite you to join us and create a software that 
					benefits the whole community.'); ?>
				</p>

				<a class="btn btn-default btn-lg section-button" role="button" 
				href="https://github.com/FreeCAD/FreeCAD/">
					<?php echo _('Get involved'); ?>
				</a>
			</div>
		</div>
	</div>

	<footer class="container-fluid footer-custom">
		<div class="row">
			<div class="col-lg-3 col-sm-6 footer-links">
				<h6><?php echo _('Community'); ?></h6>

				<ul>
					<li>
						<a href="https://github.com/FreeCAD/FreeCAD">
							Github
						</a>
					</li>

					<li>
						<a href="https://www.facebook.com/FreeCAD">
							Facebook
						</a>
					</li>

					<li>
						<a href="https://plus.google.com/u/0/communities/103183769032333474646">
							Google+
						</a>
					</li>
				</ul>
			</div>

			<div class="col-lg-3 col-sm-6 footer-links">
				<h6>Learn</h6>

				<ul>
					<li>
						<a href="https://www.freecadweb.org/wiki/Tutorials">
							<?php echo _('Tutorials'); ?>
						</a>
					</li>

					<li>
						<a href="https://www.youtube.com/results?search_query=freecad">
							<?php echo _('Youtube Videos'); ?>
						</a>
					</li>

					<li>
						<a href="https://stackexchange.com/search?q=freecad">
							Stack Exchange
						</a>
					</li>
				</ul>
			</div>

			<div class="col-lg-3 col-sm-6 footer-links">
				<h6><?php echo _('Contribute'); ?></h6>

				<ul>
					<li>
						<a href="https://www.freecadweb.org/wiki/Help_FreeCAD">
							<?php echo _('How can I help?'); ?>
						</a>
					</li>

					<li>
						<a href="https://www.freecadweb.org/wiki/Donate">
							<?php echo _('Donate'); ?>
						</a>
					</li>

					<li>
						<a href="https://crowdin.com/project/freecad">
							<?php echo _('Translate'); ?>
						</a>
					</li>
				</ul>
			</div>

			<div class="col-lg-3 col-sm-6 footer-links">
				<h6><?php echo _('Code'); ?></h6>

				<ul>
					<li>
						<a href="https://www.freecadweb.org/wiki/Compiling">
							<?php echo _('Building from source'); ?>
						</a>
					</li>

					<li>
						<a href="https://www.freecadweb.org/api/">
							<?php echo _('C++ & Python API'); ?>
						</a>
					</li>

					<li>
						<a href="https://www.freecadweb.org/wiki/Licence">
							<?php echo _('License information'); ?>
						</a>
					</li>
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
  <script src="js/popper-1.14.7.min.js"></script>
  <script src="js/bootstrap-4.3.1.min.js"></script>
</body>
</html>
