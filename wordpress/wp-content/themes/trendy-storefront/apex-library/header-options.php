<?php
/**
 * Theme Options.
 *
 * @package trendy_storefront
 */

// Add Panel.
$wp_customize->add_panel('home_option_panel',
	array(
	'title'      => __( 'Homepage Options', 'trendy-storefront' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

// Header
$wp_customize->add_section('trendy_storefront_header_settings', 
	array(    
	'title'       => __('Header Options', 'trendy-storefront'),
	'priority'   => 90,
	'panel'       => 'home_option_panel'
	)
);

$wp_customize->add_setting('trendy_storefront_currency_switcher',array(
	'default' => false,
	'sanitize_callback' => 'trendy_storefront_sanitize_checkbox',
));
$wp_customize->add_control( 'trendy_storefront_currency_switcher', array(
   'settings' => 'trendy_storefront_currency_switcher',
   'section'   => 'trendy_storefront_header_settings',
   'label'     => __('Show Currency Switcher','trendy-storefront'),
   'type'      => 'checkbox'
));

$wp_customize->add_setting('trendy_storefront_cart_language_translator',array(
	'default' => false,
	'sanitize_callback' => 'trendy_storefront_sanitize_checkbox',
));
$wp_customize->add_control( 'trendy_storefront_cart_language_translator', array(
   'settings' => 'trendy_storefront_cart_language_translator',
   'section'   => 'trendy_storefront_header_settings',
   'label'     => __('Show Language Translator','trendy-storefront'),
   'type'      => 'checkbox'
));