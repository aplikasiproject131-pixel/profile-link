<?php
/**
 * Theme Options.
 *
 * @package trendy_storefront
 */

//-------------------------------------------------------//

// Product Slider
	$wp_customize->add_section('trendy_storefront_slider_post_section', array(
	    'title'       => __('Product Slider', 'trendy-storefront'),
	    'description' => __('<p class="sec-title">Product Slider</p>', 'trendy-storefront'),
	    'priority'    => 90,
	    'panel'       => 'home_option_panel',
	));

	$wp_customize->add_setting('trendy_storefront_slider_hide',array(
		'default' => false,
		'sanitize_callback' => 'trendy_storefront_sanitize_checkbox',
	));
	$wp_customize->add_control( 'trendy_storefront_slider_hide', array(
	   'settings' => 'trendy_storefront_slider_hide',
	   'section'   => 'trendy_storefront_slider_post_section',
	   'label'     => __('Show Product Slider','trendy-storefront'),
	   'type'      => 'checkbox'
	));

	$wp_customize->add_setting('trendy_storefront_product_sub_heading', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('trendy_storefront_product_sub_heading', array(
	    'settings' => 'trendy_storefront_product_sub_heading',
	    'section'  => 'trendy_storefront_slider_post_section',
	    'label'    => __('Add Slider Title', 'trendy-storefront'),
	    'type'     => 'text',
	));

	$wp_customize->add_setting('trendy_storefront_product_heading', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('trendy_storefront_product_heading', array(
	    'settings' => 'trendy_storefront_product_heading',
	    'section'  => 'trendy_storefront_slider_post_section',
	    'label'    => __('Add Slider Text', 'trendy-storefront'),
	    'type'     => 'text',
	));

	// Get product categories if WooCommerce is active
	$trendy_storefront_cat_post = array();
	$trendy_storefront_cat_post['0'] = 'Select';
	
	if ( class_exists( 'WooCommerce' ) ) {
		$trendy_storefront_product_categories = get_terms( array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => false,
		) );
		
		if ( ! empty( $trendy_storefront_product_categories ) && ! is_wp_error( $trendy_storefront_product_categories ) ) {
			foreach ( $trendy_storefront_product_categories as $trendy_storefront_category ) {
				$trendy_storefront_cat_post[$trendy_storefront_category->slug] = $trendy_storefront_category->name;
			}
		}
	}

	$wp_customize->add_setting('trendy_storefront_slider_categories_setting', array(
	    'default' => 'product_cat4',
	    'sanitize_callback' => 'trendy_storefront_sanitize_choices',
	));

	$wp_customize->add_control('trendy_storefront_slider_categories_setting', array(
	    'type'    => 'select',
	    'choices' => $trendy_storefront_cat_post,
	    'label'   => __('Select Product Category to display Slider Left', 'trendy-storefront'),
	    'section' => 'trendy_storefront_slider_post_section',
	));

	// Get product categories for right slider
	$trendy_storefront_cat_post_right = array();
	$trendy_storefront_cat_post_right['0'] = 'Select';
	
	if ( class_exists( 'WooCommerce' ) ) {
		$trendy_storefront_product_categories_right = get_terms( array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => false,
		) );
		
		if ( ! empty( $trendy_storefront_product_categories_right ) && ! is_wp_error( $trendy_storefront_product_categories_right ) ) {
			foreach ( $trendy_storefront_product_categories_right as $trendy_storefront_category ) {
				$trendy_storefront_cat_post_right[$trendy_storefront_category->slug] = $trendy_storefront_category->name;
			}
		}
	}

// Featured Products
	$wp_customize->add_section('trendy_storefront_featured_new_arrival_section', array(
	    'title'       => __('New Arrival Section', 'trendy-storefront'),
	    'description' => __('<p class="sec-title">Featured Post</p>', 'trendy-storefront'),
	    'priority'    => 95,
	    'panel'       => 'home_option_panel',
	));

	$wp_customize->add_setting('trendy_storefront_new_arrivals_hide',array(
		'default' => false,
		'sanitize_callback' => 'trendy_storefront_sanitize_checkbox',
	));
	$wp_customize->add_control( 'trendy_storefront_new_arrivals_hide', array(
	   'settings' => 'trendy_storefront_new_arrivals_hide',
	   'section'   => 'trendy_storefront_featured_new_arrival_section',
	   'label'     => __('Show Products','trendy-storefront'),
	   'type'      => 'checkbox'
	));

	$wp_customize->add_setting('trendy_storefront_product_sec_title', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('trendy_storefront_product_sec_title', array(
	    'settings' => 'trendy_storefront_product_sec_title',
	    'section'  => 'trendy_storefront_featured_new_arrival_section',
	    'label'    => __('Add Section Title', 'trendy-storefront'),
	    'type'     => 'text',
	));

	$wp_customize->add_setting('trendy_storefront_product_sec_text', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('trendy_storefront_product_sec_text', array(
	    'settings' => 'trendy_storefront_product_sec_text',
	    'section'  => 'trendy_storefront_featured_new_arrival_section',
	    'label'    => __('Add Section Text', 'trendy-storefront'),
	    'type'     => 'text',
	));



	// Promo Boxes Section
$wp_customize->add_section('trendy_storefront_slider_boxes_section', array(
    'title'       => __('Slider Promo Boxes', 'trendy-storefront'),
    'description' => __('<p class="sec-title">Slider Boxes</p>', 'trendy-storefront'),
    'priority'    => 96,
    'panel'       => 'home_option_panel',
));

$wp_customize->add_setting('trendy_storefront_slider_boxes_hide',array(
    'default' => true,
    'sanitize_callback' => 'trendy_storefront_sanitize_checkbox',
));

$wp_customize->add_control( 'trendy_storefront_slider_boxes_hide', array(
   'settings' => 'trendy_storefront_slider_boxes_hide',
   'section'  => 'trendy_storefront_slider_boxes_section',
   'label'    => __('Show Section','trendy-storefront'),
   'type'     => 'checkbox'
));



// Box 1 Image
$wp_customize->add_setting('trendy_storefront_slider_box1_image',array(
    'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'trendy_storefront_slider_box1_image',
        array(
            'label' => __('Box 1 Image','trendy-storefront'),
            'section' => 'trendy_storefront_slider_boxes_section',
        )
    )
);

// Box 1 Title
$wp_customize->add_setting('trendy_storefront_slider_box1_title', array(
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('trendy_storefront_slider_box1_title', array(
    'label' => __('Box 1 Title','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
    'type' => 'text',
));

$wp_customize->add_setting('trendy_storefront_slider_box1_text', array(
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('trendy_storefront_slider_box1_text', array(
    'label' => __('Box 1 Text','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
    'type' => 'text',
));

// Box 1 Button Text
$wp_customize->add_setting('trendy_storefront_slider_box1_btn', array(
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('trendy_storefront_slider_box1_btn', array(
    'label' => __('Box 1 Button Text','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
    'type' => 'text',
));

// Box 1 Link
$wp_customize->add_setting('trendy_storefront_slider_box1_link', array(
    'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control('trendy_storefront_slider_box1_link', array(
    'label' => __('Box 1 Link','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
    'type' => 'url',
));







$wp_customize->add_setting('trendy_storefront_review_img1',array(
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'trendy_storefront_review_img1',array(
    'label' => __('Customer Image 1','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
)));

$wp_customize->add_setting('trendy_storefront_review_img2',array(
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'trendy_storefront_review_img2',array(
    'label' => __('Customer Image 2','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
)));

$wp_customize->add_setting('trendy_storefront_review_img3',array(
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'trendy_storefront_review_img3',array(
    'label' => __('Customer Image 3','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
)));

$wp_customize->add_setting('trendy_storefront_review_img4',array(
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'trendy_storefront_review_img4',array(
    'label' => __('Customer Image 4','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
)));

$wp_customize->add_setting('trendy_storefront_review_number', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('trendy_storefront_review_number', array(
    'label' => __('Review Count','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
    'type' => 'text',
));

$wp_customize->add_setting('trendy_storefront_review_label', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('trendy_storefront_review_label', array(
    'label' => __('Review Label','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
    'type' => 'text',
));

$wp_customize->add_setting('trendy_storefront_review_text', array(
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('trendy_storefront_review_text', array(
    'label' => __('Review Description','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
    'type' => 'textarea',
));

$wp_customize->add_setting('trendy_storefront_review_rating', array(
    'default' => '5',
    'sanitize_callback' => 'absint',
));

$wp_customize->add_control('trendy_storefront_review_rating', array(
    'label' => __('Review Rating (1-5)','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
    'type' => 'number',
    'input_attrs' => array(
        'min'  => 1,
        'max'  => 5,
        'step' => 1,
    ),
));



$wp_customize->add_setting('trendy_storefront_slider_box3_image',array(
    'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'trendy_storefront_slider_box3_image',
        array(
            'label' => __('Box 3 Image','trendy-storefront'),
            'section' => 'trendy_storefront_slider_boxes_section',
        )
    )
);

$wp_customize->add_setting('trendy_storefront_slider_box3_title', array(
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('trendy_storefront_slider_box3_title', array(
    'label' => __('Box 3 Title','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
    'type' => 'text',
));

$wp_customize->add_setting('trendy_storefront_slider_box3_text', array(
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('trendy_storefront_slider_box3_text', array(
    'label' => __('Box 3 Text','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
    'type' => 'text',
));

$wp_customize->add_setting('trendy_storefront_slider_box3_btn', array(
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('trendy_storefront_slider_box3_btn', array(
    'label' => __('Box 3 Button Text','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
    'type' => 'text',
));

$wp_customize->add_setting('trendy_storefront_slider_box3_link', array(
    'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control('trendy_storefront_slider_box3_link', array(
    'label' => __('Box 3 Link','trendy-storefront'),
    'section' => 'trendy_storefront_slider_boxes_section',
    'type' => 'url',
));