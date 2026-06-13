<?php
/**
 * Footer Options.
 *
 * @package trendy_storefront
 */

// Add Panel.
$wp_customize->add_panel( 'footer_option_panel',
	array(
		'title'      => __( 'Footer Options', 'trendy-storefront' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
	)
);

// Footer text section
$wp_customize->add_section('section_footer', array(    
	'title' => __('Footer Text Options', 'trendy-storefront'),
	'panel' => 'footer_option_panel'    
));

// ✅ Add Setting
$wp_customize->add_setting('trendy_storefront_copyright_option', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field',
));

// ✅ Add Control
$wp_customize->add_control('trendy_storefront_copyright_option', array(
	'label'   => __('Footer Copyright Text', 'trendy-storefront'),
	'section' => 'section_footer',
	'type'    => 'text',
));