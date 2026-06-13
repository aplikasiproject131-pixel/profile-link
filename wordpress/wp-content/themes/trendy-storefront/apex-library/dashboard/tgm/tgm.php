<?php

require get_template_directory() . '/apex-library/dashboard/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function trendy_storefront_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'WooCommerce', 'trendy-storefront' ),
			'slug'             => 'woocommerce',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'YITH WooCommerce Wishlist', 'trendy-storefront' ),
			'slug'             => 'yith-woocommerce-wishlist',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Translate WordPress with GTranslate', 'trendy-storefront' ),
			'slug'             => 'gtranslate',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Currency Switcher for WooCommerce', 'trendy-storefront' ),
			'slug'             => 'currency-switcher-woocommerce',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'trendy_storefront_register_recommended_plugins' );