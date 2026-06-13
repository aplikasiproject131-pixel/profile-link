<?php
/**
 * @package Trendy Storefront 
 * Setup the WordPress core custom header feature.
 *
 * @uses trendy_storefront_header_style()
*/
function trendy_storefront_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'trendy_storefront_custom_header_args', array(
		'header-text' 			 =>	false,
		'width'                  => 1200,
		'height'                 => 300,
		'flex-width'    		 => true,
		'flex-height'    		 => true,
		'wp-head-callback'       => 'trendy_storefront_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'trendy_storefront_custom_header_setup' );

if ( ! function_exists( 'trendy_storefront_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see trendy_storefront_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'trendy_storefront_header_style' );

function trendy_storefront_header_style() {
	$trendy_storefront_header_image = get_header_image() ? get_header_image() : get_template_directory_uri() . '/assets/images/header-img.png';
	$trendy_storefront_custom_css = "
        .box-image .single-page-img{
			background-image: url('" . esc_url($trendy_storefront_header_image) . "');
			background-repeat: no-repeat;
	        background-position: center center;
	        background-size: cover !important;
	        height: 300px;
		}";
	   	wp_add_inline_style( 'trendy-storefront-style', $trendy_storefront_custom_css );
}
endif;