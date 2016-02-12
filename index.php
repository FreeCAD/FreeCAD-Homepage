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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html lang="<?php echo $lang;?>">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo _('FreeCAD: An open-source parametric 3D CAD modeler'); ?></title>
        <link rel="stylesheet" href="css/bootstrap-3.3.5.min.css">
        <link rel="stylesheet" href="css/font-awesome-4.4.0.min.css">
        <link rel="stylesheet" type="text/css" href="css/freecad.css">
        <link rel="shortcut icon" href="images/favicon.ico">
    </head>
    
    <body>
    
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only"><?php echo _('Toggle navigation'); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img alt="FreeCAD-logo" src="images/logo.png"/> FreeCAD</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li><a href="http://forum.freecadweb.org"><?php echo _('Forum'); ?></a></li>
                    <li><a href="wiki/?<?php echo _('title=Main_Page'); ?>"><?php echo _('Documentation'); ?></a></li>
                    <li><a href="tracker/"><?php echo _('Bug tracker'); ?></a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
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
                            <li><a href="/?lang=pt_BR"><img src="lang/pt_BR/flag.jpg"/> <?php echo 'Portuguese, Brazilian'; ?></a></li>
                            <li><a href="/?lang=el"><img src="lang/el/flag.jpg"/> <?php echo 'Greek'; ?></a></li>
                            <li><a href="/?lang=sk"><img src="lang/sk/flag.jpg"/> <?php echo 'Slovak'; ?></a></li>
                            <li><a href="/?lang=tr"><img src="lang/tr/flag.jpg"/> <?php echo 'Turkish'; ?></a></li>
                            <li><a href="/?lang=sl"><img src="lang/sl/flag.jpg"/> <?php echo 'Slovenian'; ?></a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    
    <div class="container maincontent">
        <div class="row">
            
            <div class="col-md-3" id="leftCol">
                <ul class="nav nav-stacked" id="sidebar">
                    <li><a href="wiki/?<?php echo _('title=About_FreeCAD'); ?>"><?php echo _('Overview'); ?></a></li>
                    <li><a href="wiki/?<?php echo _('title=Feature_list'); ?>"><?php echo _('Features'); ?></a></li>
                    <li><a href="wiki/?<?php echo _('title=Screenshots'); ?>"><?php echo _('Screenshots'); ?></a></li>
                    <li><a href="wiki/?<?php echo _('title=Download'); ?>"><?php echo _('Download'); ?></a></li>
                    <li><a href="wiki/?<?php echo _('title=Getting_started'); ?>"><?php echo _('Getting started'); ?></a></li>
                    <li><a href="http://forum.freecadweb.org/viewforum.php?f=24"><?php echo _('Users showcase'); ?></a></li>
                    <li><a href="http://forum.freecadweb.org/viewforum.php?f=3"><?php echo _('Get help'); ?></a></li>
                </ul>
            </div>
            
            <div class="col-md-9" role="main">
                
                <h1><?php echo _('Welcome!'); ?></h1>
                
                <p>
                    <?php echo _('FreeCAD is a parametric 3D modeler made primarily to design real-life objects of any size. <a href="http://en.wikipedia.org/wiki/Parametric_feature_based_modeler">Parametric modeling</a> allows you to easily modify your design by going back into your model history and changing its parameters. FreeCAD is open-source and highly customizable, scriptable and extensible.'); ?>
                </p>
                <p>
                    <?php echo _('FreeCAD is multiplatfom (Windows, Mac and Linux), and reads and writes many open file formats such as STEP, IGES, STL, SVG, DXF, OBJ, IFC, DAE and many others.'); ?>
                </p>
                <p>
                    <a href="wiki/?<?php echo _('title=About_FreeCAD'); ?>"><?php echo _('Read more...'); ?></a>
                </p>

                <h4><?php echo _('Who is FreeCAD for? A couple of user cases:'); ?></h4>
                
                <p>
                    <?php echo _('The <b>home user/hobbyist</b>. Got yourself a project you want to build, have built, or 3D printed? Model it in FreeCAD. No previous CAD experience required. Our community will help you get the hang of it quickly!'); ?>
                </p>
                <p>
                    <?php echo _('The <b>experienced CAD user</b>. If you use commercial CAD or BIM modeling software at work, you will find similar tools and workflow among the many <a href="wiki/?title=Workbenches">workbenches</a> of FreeCAD.'); ?>
                </p>
                <p>
                    <?php echo _('The <b>programmer</b>. Almost all of FreeCAD\'s functionality is accessible to <a href="https://en.wikipedia.org/wiki/Python_%28programming_language%29">Python</a>. You can easily extend FreeCAD\'s functionality, automatize it with scripts, build your own modules or even embed FreeCAD in your own application.'); ?>
                </p>
                <p>
                    <?php echo _('The <b>educator</b>. Teach your students a free software with no worry about license purchase. They can install the same version at home and continue using it after leaving school.'); ?>
                </p>
                
            </div>
        </div>
    </div>


    <footer>
        <div class="container text-muted">
            <div class="row">
                <div class="col-md-3">
                    <?php echo _('Community'); ?>
                    <ul>
                        <li><a href="https://github.com/FreeCAD/FreeCAD">Github</a></li>
                        <li><a href="https://www.facebook.com/FreeCAD">Facebook</a></li>
                        <li><a href="https://plus.google.com/u/0/communities/103183769032333474646">Google+</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <?php echo _('Learn'); ?>
                    <ul>
                        <li><a href="wiki/?<?php echo _('title=Tutorials'); ?>"><?php echo _('Tutorials'); ?></a></li>
                        <li><a href="https://www.youtube.com/results?search_query=freecad"><?php echo _('Youtube videos'); ?></a></li>
                        <li><a href="http://area51.stackexchange.com/proposals/88434/freecad">Stack Exchange</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <?php echo _('Help the project'); ?>
                    <ul>
                        <li><a href="wiki/?<?php echo _('title=Help_FreeCAD'); ?>"><?php echo _('How can I help?'); ?></a></li>
                        <li><a href="wiki/?<?php echo _('title=Donate'); ?>"><i class="fa fa-heart"></i> <?php echo _('Donate!'); ?></a></li>
                        <li><a href="https://crowdin.com/project/freecad"><?php echo _('Translate'); ?></a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <?php echo _('Code'); ?>
                    <ul>
                        <li><a href="wiki/?<?php echo _('title=Compiling'); ?>"><?php echo _('Building from source'); ?></a></li>
                        <li><a href="api/"><?php echo _('C++ & Python API'); ?></a></li>
                        <li><a href="wiki/?<?php echo _('title=Licence'); ?>"><?php echo _('License information'); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap-3.3.5.min.js"></script>
    
    </body>
    
</html>
