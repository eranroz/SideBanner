<?php
if ( ! defined( 'MEDIAWIKI' ) )
	die();
/**#@+
 * A simple extension to add a side banner to mediawiki (set by administrators using MediaWiki:SideBanner-banner)
 *
 * @author Eran Roz
 * @copyright MIT
 */
$wgHooks['BeforePageDisplay'][] = 'wfSideBannerBeforePageDisplay';
$wgExtensionMessagesFiles['SideBanner'] = dirname( __FILE__ ) . "/SideBanner.i18n.php";


$wgExtensionCredits['other'][] = array(
	'path'           => __FILE__,
	'name'           => 'SideBanner',
	'author'         => array( 'Eran Roz' ),
	'descriptionmsg' => 'sidebanner-desc',
	'url'            => 'https://github.com/eranroz',
);

// Resources

$sidebarResourceTemplate = array(
	'localBasePath' => dirname(__FILE__) . '/modules',
	'remoteExtPath' => 'SideBanner/modules'
);

$wgResourceModules['ext.sidebanner'] = $sidebarResourceTemplate + array(
	'styles' => array('ext.SideBanner.css' ),
	'scripts' => '',
	'position' => 'top',
	'dependencies' => array(),
);

/**
 * @param $out OutputPage
 * @param $sk Skin
 * @return bool
 */
function wfSideBannerBeforePageDisplay( $out, &$sk ) {
	$banner = wfMessage( 'SideBanner-banner' );
	if ( $banner->plain() != '-' ) {
		$out->addModules( 'ext.sidebanner' );
		$out->prependHTML( '<div class="SideBanner">' . $banner->parse() . '</div>' );
	}
	return true;
}

/**#@-*/
