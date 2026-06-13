<?php
/**
 * Settings for demo import
 *
 */

/**
 * Define constants
 **/
if ( ! defined( 'WHIZZIE_DIR' ) ) {
	define( 'WHIZZIE_DIR', dirname( __FILE__ ) );
}
require trailingslashit( WHIZZIE_DIR ) . 'dashboard-contents.php';
$trendy_storefront_current_theme = wp_get_theme();
$trendy_storefront_theme_title = $trendy_storefront_current_theme->get( 'Name' );


/**
 * Make changes below
 **/

// Change the title and slug of your wizard page
$config['trendy_storefront_page_slug'] 	= 'trendy-storefront';
$config['trendy_storefront_page_title']	= 'Begin Installation';

$config['steps'] = array(
	'plugins' => array(
		'id'			=> 'plugins',
		'title'			=> __( 'Install and Activate Recommended Plugins', 'trendy-storefront' ),
		'icon'			=> 'admin-plugins',
		'button_text'	=> __( 'Install Recommended Plugins', 'trendy-storefront' ),
		'can_skip'		=> false
	),
	'widgets' => array(
		'id'			=> 'widgets',
		'title'			=> __( 'Begin With Demo Import', 'trendy-storefront' ),
		'icon'			=> 'welcome-widgets-menus',
		'button_text'	=> __( 'Begin With Demo Import', 'trendy-storefront' ),
		'can_skip'		=> false
	),
	'done' => array(
		'id'			=> 'done',
		'title'			=> __( 'Customize Your Site', 'trendy-storefront' ),
		'icon'			=> 'yes',
	)
);

/**
 * This kicks off the wizard
 **/
if( class_exists( 'Trendy_Storefront_Whizzie' ) ) {
	$Trendy_Storefront_Whizzie = new Trendy_Storefront_Whizzie( $config );
}