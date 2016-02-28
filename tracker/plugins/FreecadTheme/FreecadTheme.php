<?php
require_once( config_get( 'class_path' ) . 'MantisPlugin.class.php' );

class FreeCADThemePlugin extends MantisPlugin {
    
    function register() {
        $this->name = 'FreeCAD Theme';
        $this->description = 'FreeCAD theme for mantis, based on bootstrap';
        $this->version = '0.0.1';
        $this->requires = array(
            'MantisCore' => '1.2.0',
            'Search' => '0.0.4',
        );
        $this->author = 'Yorik van Havre';
        $this->contact = 'yorik@uncreated.net';
        $this->url = 'http://www.freecadweb.org';
    }

    function hooks() {
        $hooks = array(
            'EVENT_LAYOUT_RESOURCES' => 'include_resource',
            'EVENT_LAYOUT_BODY_BEGIN' => 'include_navbar',
            'EVENT_LAYOUT_BODY_END' => 'include_footer',
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
        return  $t_return;
    }

    function include_navbar() {
        $t_return = '';
        $t_return .= '
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/" title="FreeCAD homepage"><img src="/images/logo.png" alt="Logo"/> FreeCAD</a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Issues <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="my_view_page.php" title="Issues"><i class="fa fa-gear"></i> My view</a></li>
                                <li><a href="view_all_bug_page.php" title="Issues"><i class="fa fa-cogs"></i> All issues</a></li>';
        if( !current_user_is_anonymous() ) {
            $t_return .='                                <li><a href="http://forum.freecadweb.org/viewtopic.php?f=3&t=5236"><i class="fa fa-exclamation-triangle"></i> Read this before reporting</a></li>
                                <li><a href="bug_report_page.php"><i class="fa fa-play"></i> Report issue</a></li>';
        }
        $t_return .='                            </ul> 
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Changes <span class="caret"></span></a>
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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.current_user_get_field( 'username' ).'<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="account_page.php"><i class="fa fa-user"></i> My account</a></li>';
                                
            if( access_has_global_level( config_get( 'manage_site_threshold' ) ) ) {
                $t_return .= '                              <li><a href="manage_overview_page.php"><i class="fa fa-cogs"></i> Manage</a></li>';
            }
            $t_return .='                               <li><a href="logout_page.php"><i class="fa fa-user"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>';
        }
        $t_return .='                   <form class="navbar-search navbar-form navbar-right" action="/tracker/plugin.php?page=Search/search" id="searchform" role="search" method="post">';
        $t_return .= form_security_field( 'plugin_Search_search_press' );
        $t_return .='                       <div>
                            <input class="form-control" type="search" name="text" placeholder="Search" title="Search issues" maxlength=300>
                            <input type="hidden" name="title" value="Search">
                        </div>
                    </form>';
        $t_return .='               </div>
            </div>
        </div><!-- topbar -->
        <div class="container maincontents">
            <div class="row">
                <div class="col-md-12">';
        return $t_return;
    }
    
    function include_footer() {
        $t_return = '</div><!-- col --></div><!-- row --></div><!-- container -->';
        $t_return .='    <footer>
        <div class="container text-muted">
            <div class="row">
                <div class="col-md-3">
                    Community
                    <ul>
                        <li><a href="https://github.com/FreeCAD/FreeCAD">Github</a></li>
                        <li><a href="https://www.facebook.com/FreeCAD">Facebook</a></li>
                        <li><a href="https://plus.google.com/u/0/communities/103183769032333474646">Google+</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    Learn
                    <ul>
                        <li><a href="/wiki/?title=Tutorials">Tutorials</a></li>
                        <li><a href="https://www.youtube.com/results?search_query=freecad">Youtube videos</a></li>
                        <li><a href="http://area51.stackexchange.com/proposals/88434/freecad">Stack Exchange</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    Help the project
                    <ul>
                        <li><a href="/wiki/?Help_FreeCAD">How can I help?</a></li>
                        <li><a href="/wiki/?title=Donate"><i class="fa fa-heart"></i> Donate!</a></li>
                        <li><a href="https://crowdin.com/project/freecad">Translate</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    Code
                    <ul>
                        <li><a href="/wiki/?title=Compiling">Building from source</a></li>
                        <li><a href="/api/">C++ & Python API</a></li>
                        <li><a href="/wiki/?title=Licence">License information</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="/js/jquery-2.1.4.min.js"></script>
    <script src="/js/bootstrap-3.3.5.min.js"></script>';
        return $t_return;
    }
}

?>
