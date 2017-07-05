<?php
require_once( config_get( 'class_path' ) . 'MantisPlugin.class.php' );

class FreeCADThemePlugin extends MantisPlugin {
    
    function register() {
        $this->name = 'FreeCAD Theme';
        $this->description = 'FreeCAD theme for mantis, based on bootstrap';
        $this->version = '0.0.2';
        $this->requires = array(
            'MantisCore' => '2.0.0',
        );
        $this->author = 'Yorik van Havre';
        $this->contact = 'yorik@uncreated.net';
        $this->url = 'http://www.freecadweb.org';
    }

    function hooks() {
        $hooks = array(
            'EVENT_LAYOUT_RESOURCES' => 'include_resource',
            'EVENT_LAYOUT_BODY_BEGIN' => 'include_navbar',
        );
        return $hooks;
    }
    
    function install() {
        return true;
    }

    function include_resource() {
        $t_return = '';
        $t_return .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />';
        $t_return .= '<link rel="stylesheet" href="/css/bootstrap-3.3.5.min.css">';
        $t_return .= '<link rel="stylesheet" href="/css/font-awesome-4.4.0.min.css">';
        $t_return .= '<link rel="stylesheet" href="/css/freecad.css">';
        $t_return .= '<link rel="stylesheet" href="/tracker/plugins/FreecadTheme/freecad.css">';
        $t_return .= '<script type="text/javascript" src="/tracker/plugins/FreecadTheme/freecad.js"></script>';
        return  $t_return;
    }

    function include_navbar() {
        $t_return = '';
        $t_return .= '
        <div class="navbar navbar-inverse navbar-fixed-top fc-header" role="navigation" style="background: #222;">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/" title="FreeCAD homepage" style="font-size: 18px;"><img src="/images/logo.png" alt="Logo"/> FreeCAD</a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle hidden-lg hidden-md" data-toggle="dropdown">Issues <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="my_view_page.php" title="Issues">My view</a></li>
                                <li><a href="view_all_bug_page.php" title="Issues">All issues</a></li>';
        if( !current_user_is_anonymous() ) {
            $t_return .='                                <li><a href="http://forum.freecadweb.org/viewtopic.php?f=3&t=5236">Read this before reporting</a></li>
                                <li><a href="bug_report_page.php">Report issue</a></li>';
        }
        $t_return .='                            </ul> 
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle hidden-lg hidden-md" data-toggle="dropdown">Changes <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="plugin.php?page=Source/list&id=2" title="Commits">Commits</a></li>
                                <li><a href="changelog_page.php" title="Changelog">Changes log</a></li>
                                <li><a href="roadmap_page.php" title="Roadmap">Roadmap</a></li>
                            </ul>
                        </li>
                    </ul>';
        if( !current_user_is_anonymous() ) {
            $t_return .='                   <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size: 14px; padding: 15px;">'.current_user_get_field( 'username' ).'<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="account_page.php"><i class="fa fa-user"></i> My account</a></li>';
                                
            if( access_has_global_level( config_get( 'manage_site_threshold' ) ) ) {
                $t_return .= '                              <li><a href="manage_overview_page.php"><i class="fa fa-cogs"></i> Manage</a></li>';
            }
            if( access_has_global_level( config_get( 'handle_bug_threshold' ) ) ) {
                $t_return .= '                              <li><a href="summary_page.php"><i class="fa fa-cogs"></i> Statistics</a></li>';

            }
            $t_return .='                               <li><a href="logout_page.php"><i class="fa fa-user"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>';
        }
	    $t_return .='                   <form class="navbar-search navbar-form navbar-right" action="/tracker/search.php" id="searchform" role="search" method="get">';
	    $t_return .='                       <div>
                            <input class="form-control" type="search" name="search" placeholder="Search" title="Search issues" maxlength=300 style="border-radius: 4px !important;">
                            <input type="hidden" name="title">
                        </div>
                    </form>';
            $t_return .= '<ul class="nav navbar-nav navbar-right">
                        <li><a href="http://forum.freecadweb.org" style="font-size: 14px;"><i class="fa fa-commenting"></i></a></li>
                        <li><a href="/wiki/" style="font-size: 14px;"><i class="fa fa-book"></i></a></li>
                    </ul>';
        $t_return .='               </div>
            </div>
        </div>';
        return $t_return;
    }
    
}

?>
