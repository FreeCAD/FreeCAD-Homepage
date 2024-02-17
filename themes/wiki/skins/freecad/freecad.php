<?php
/**
 * freecad
 *
 * @freecad.php
 * @ingroup Skins
 * @author Yorik van Havre
 * @license GNU General Public License 2.0 or later
 */

if ( ! defined( 'MEDIAWIKI' ) ) die( "This is an extension to the MediaWiki package and cannot be run standalone." );

$wgExtensionCredits['skin'][] = array(
    'path'        => __FILE__,
    'name'        => 'freecad',
    'url'         => 'http://www.freecad.org',
    'author'      => '[http://yorik.uncreated.net Yorik van Havre]',
    'description' => 'MediaWiki skin based on bootstrap-mediawiki',
);

$wgValidSkinNames['freecad'] = 'freecad';
$wgAutoloadClasses['Skinfreecad'] = __DIR__ . '/freecad.skin.php';


$skinDirParts = explode( DIRECTORY_SEPARATOR, __DIR__ );
$skinDir = array_pop( $skinDirParts );

$wgResourceModules['skins.freecad'] = array(
    'styles' => array(
        //$skinDir . '/bootstrap/css/bootstrap.min.css'            => array( 'media' => 'all' ),
        $skinDir . '/../../../css/bootstrap-3.3.5.min.css'       => array( 'media' => 'all' ),
        $skinDir . '/google-code-prettify/prettify.css'          => array( 'media' => 'all' ),
        $skinDir . '/style.css'                                  => array( 'media' => 'all' ),
        $skinDir . '/../../../css/freecad.css'                   => array( 'media' => 'all' ),
    ),
    'scripts' => array(
        //$skinDir . '/bootstrap/js/bootstrap.min.js',
        $skinDir . '/../../../js/bootstrap-3.3.5.min.js',
        $skinDir . '/google-code-prettify/prettify.js',
        $skinDir . '/js/jquery.ba-dotimeout.min.js',
        $skinDir . '/js/behavior.js',
    ),
    'dependencies' => array(
        'jquery',
        'jquery.mwExtension',
        'jquery.client',
        'jquery.cookie',
    ),
    'remoteBasePath' => &$GLOBALS['wgStylePath'],
    'localBasePath'  => &$GLOBALS['wgStyleDirectory'],
    'position'=> 'top',
);

if ( isset( $wgSiteJS ) ) {
    $wgResourceModules['skins.freecad']['scripts'][] = $skinDir . '/' . $wgSiteJS;
}//end if

if ( isset( $wgSiteCSS ) ) {
    $wgResourceModules['skins.freecad']['styles'][] = $skinDir . '/' . $wgSiteCSS;
}//end if
