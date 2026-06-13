<?php
/**
 * Trendy Storefront functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package trendy_storefront
 */

if ( ! function_exists( 'trendy_storefront_setup' ) ) :
	function trendy_storefront_setup() {
		add_theme_support( 'automatic-feed-links' );

		load_theme_textdomain( 'trendy-storefront', get_template_directory() . '/languages' );
		
		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'woocommerce' );

		register_nav_menus( array(
			'primary_menu' 		=> esc_html__( 'Primary Menu', 'trendy-storefront' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', array(
			'default-color' => 'ffffff'
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		add_editor_style( array( '/assets/css/editor-style.css', trendy_storefront_get_fonts_url() ) );

		// Gutenberg support
		add_theme_support( 'editor-color-palette', array(
	       	array(
				'name' => esc_html__( 'Blue', 'trendy-storefront' ),
				'slug' => 'blue',
				'color' => '#2c7dfa',
	       	),
	       	array(
	           	'name' => esc_html__( 'Green', 'trendy-storefront' ),
	           	'slug' => 'green',
	           	'color' => '#07d79c',
	       	),
	       	array(
	           	'name' => esc_html__( 'Orange', 'trendy-storefront' ),
	           	'slug' => 'orange',
	           	'color' => '#ff8737',
	       	),
	       	array(
	           	'name' => esc_html__( 'Black', 'trendy-storefront' ),
	           	'slug' => 'black',
	           	'color' => '#2f3633',
	       	),
	       	array(
	           	'name' => esc_html__( 'Grey', 'trendy-storefront' ),
	           	'slug' => 'grey',
	           	'color' => '#82868b',
	       	),
	   	));

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
		   	array(
		       	'name' => esc_html__( 'small', 'trendy-storefront' ),
		       	'shortName' => esc_html__( 'S', 'trendy-storefront' ),
		       	'size' => 12,
		       	'slug' => 'small'
		   	),
		   	array(
		       	'name' => esc_html__( 'regular', 'trendy-storefront' ),
		       	'shortName' => esc_html__( 'M', 'trendy-storefront' ),
		       	'size' => 16,
		       	'slug' => 'regular'
		   	),
		   	array(
		       	'name' => esc_html__( 'larger', 'trendy-storefront' ),
		       	'shortName' => esc_html__( 'L', 'trendy-storefront' ),
		       	'size' => 36,
		       	'slug' => 'larger'
		   	),
		   	array(
		       	'name' => esc_html__( 'huge', 'trendy-storefront' ),
		       	'shortName' => esc_html__( 'XL', 'trendy-storefront' ),
		       	'size' => 48,
		       	'slug' => 'huge'
		   	)
		));
		add_theme_support('editor-styles');
		add_theme_support( 'wp-block-styles' );

		/**
		 * Demo Import
		 */
		require get_template_directory() . '/apex-library/dashboard/dashboard-settings.php';
	}
endif;
add_action( 'after_setup_theme', 'trendy_storefront_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function trendy_storefront_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'trendy_storefront_content_width', 790 );
}
add_action( 'after_setup_theme', 'trendy_storefront_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function trendy_storefront_widgets_init() {
	register_sidebar( 
		array(
			'name'          => esc_html__( 'Sidebar', 'trendy-storefront' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'trendy-storefront' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) 
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'trendy-storefront' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'trendy-storefront' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'trendy-storefront' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'trendy-storefront' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 3', 'trendy-storefront' ),
			'id'            => 'sidebar-4',
			'description'   => __( 'Add widgets here to appear in your footer.', 'trendy-storefront' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'trendy_storefront_widgets_init' );

/**
* Enqueue theme fonts.
*/
function trendy_storefront_fonts() {
	$fonts_url = trendy_storefront_get_fonts_url();

	// Load Fonts if necessary.
	if ( $fonts_url ) {
		require_once get_theme_file_path( 'apex-library/wptt-webfont-loader.php' );
		wp_enqueue_style( 'trendy-storefront-fonts', trendy_storefront_wptt_get_webfont_url( $fonts_url ), array(), null );
	}
}
add_action( 'wp_enqueue_scripts', 'trendy_storefront_fonts', 1 );
add_action( 'enqueue_block_editor_assets', 'trendy_storefront_fonts', 1 );

/**
 * Retrieve webfont URL to load fonts locally.
 */
function trendy_storefront_get_fonts_url() {
	$font_families = array(
		'Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900',
		'Syne:wght@400..800',
	);

	$query_args = array(
		'family'  => urlencode( implode( '|', $font_families ) ),
		'subset'  => urlencode( 'latin,latin-ext' ),
		'display' => urlencode( 'swap' ),
	);

	return apply_filters( 'trendy_storefront_get_fonts_url', add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );
}

/**
 * Enqueue scripts and styles.
 */
function trendy_storefront_scripts() {

	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css' );

	wp_enqueue_style( 'bootstrap-icon', get_template_directory_uri() . '/assets/css/bootstrap-icons.css' );

	wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/assets/css/owl.carousel.css' );

	wp_enqueue_style( 'trendy-storefront-navigation-css', get_template_directory_uri() . '/assets/css/navigation.css' );

	wp_enqueue_style( 'trendy-storefront-blocks', get_template_directory_uri() . '/assets/css/blocks.css' );
	
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/assets/css/fontawesome-all.css' );

	wp_enqueue_style( 'trendy-storefront-style', get_stylesheet_uri() );
	wp_style_add_data('trendy-storefront-style', 'rtl', 'replace');

	wp_enqueue_script( 'trendy-storefront-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), '1.0', true );

	wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '1.0', true );

	wp_enqueue_script( 'trendy-storefront-navigation-js', get_template_directory_uri() . '/assets/js/navigation.js', array('jquery'), '1.0', true );
	
	wp_enqueue_script( 'trendy-storefront-custom-script', get_template_directory_uri() . '/assets/js/theme-custom-script.js', array('jquery'), '20151215', true );

	// Localize script for AJAX
	wp_localize_script( 'trendy-storefront-custom-script', 'trendy_storefront_ajax_object', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce'    => wp_create_nonce( 'trendy_storefront_filter_nonce' )
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'trendy_storefront_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since Trendy Storefront 1.0.0
 */
function trendy_storefront_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'trendy-storefront-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'trendy-storefront-fonts', trendy_storefront_get_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'trendy_storefront_block_editor_styles' );

/**
 * Checkbox sanitization callback example.
 */
function trendy_storefront_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Removing category text from category page.
 */
function trendy_storefront_category_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'trendy_storefront_category_title' );

/*radio button sanitization*/
function trendy_storefront_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/apex-library/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/apex-library/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/apex-library/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/apex-library/customizer.php';

/**
 * SVG icons functions and filters.
 */
require get_template_directory() . '/apex-library/icon-functions.php';

/**
 * Get Started Page.
 */
require get_template_directory() . '/apex-library/theme-info.php';

function trendy_storefront_set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        $count = 1;
        update_post_meta($postID, $count_key, $count);
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Get post views
function trendy_storefront_get_post_views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    return $count ? $count . ' ' : '0 ';
}

// Hook into wp_head to count on single posts
function trendy_storefront_track_post_views($post_id) {
    if (!is_single()) return;
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    trendy_storefront_set_post_views($post_id);
}
add_action('wp_head', 'trendy_storefront_track_post_views');

/**
 * AJAX Handler for filtering products by category
 */
function trendy_storefront_filter_products_by_category() {
    // Verify nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'trendy_storefront_filter_nonce' ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Security check failed.', 'trendy-storefront' ) ) );
    }
    
    $category_slug = isset( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : '';
    
    if ( empty( $category_slug ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'No category selected.', 'trendy-storefront' ) ) );
    }
    
    // Query products
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 3,
        'tax_query'      => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $category_slug,
            ),
        ),
    );
    
    $products_query = new WP_Query( $args );
    
    if ( ! $products_query->have_posts() ) {
        wp_send_json_error( array( 'message' => esc_html__( 'No products found in this category.', 'trendy-storefront' ) ) );
    }
    
    // Build HTML output
    ob_start();
    
    while ( $products_query->have_posts() ) : $products_query->the_post();
        global $product;
        ?>
        <div class="slider-cat-main mb-3">
            <div class="slider-news-image">
                <?php if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'full', array( 'class' => 'post-image' ) );
                } else { ?>
                    <img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" alt="<?php echo esc_attr( 'product', 'trendy-storefront' ); ?>"/>
                <?php } ?>
            </div>
            <div class="slider-news-content">
                <h4 class="slider-title mb-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="meta-box">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 align-self-center">
                        <p class="prod-counts mb-2">
                            <i class="bi bi-star-fill me-2"></i>
                            <?php 
                            $rating_count = $product->get_rating_count();
                            $average = $product->get_average_rating();
                            echo $average > 0 ? number_format( $average, 1 ) : esc_html__( 'No rating', 'trendy-storefront' );
                            ?>
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 align-self-center">
                        <p class="post-comments mb-2">
                            <i class="bi bi-tag me-2"></i>
                            <?php echo $product->get_price_html(); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endwhile;
    
    wp_reset_postdata();
    
    $html = ob_get_clean();
    
    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_filter_products_by_category', 'trendy_storefront_filter_products_by_category' );
add_action( 'wp_ajax_nopriv_filter_products_by_category', 'trendy_storefront_filter_products_by_category' );



// Add admin notice
function trendy_storefront_admin_notice() { 
    global $pagenow;

    $trendy_storefront_theme = wp_get_theme();
    $trendy_storefront_meta  = get_option('trendy_storefront_admin_notice');
    $trendy_storefront_screen                  = get_current_screen();

    if ( !$trendy_storefront_meta ) {

        if ( is_network_admin() || ! current_user_can('manage_options') ) {
            return;
        }

        if ( $trendy_storefront_screen->base !== 'appearance_page_trendy-storefront-info' ) {

            $trendy_storefront_version = $trendy_storefront_theme->get('Version');
            ?>

            <div class="notice trendy-storefront-notice-main-div">

                <!-- Dismiss -->
				<a class="trendy-storefront-dismiss" href="<?php echo esc_url( add_query_arg( 'trendy_storefront_admin_notice', '1' ) ); ?>">
					<span class="dashicons dashicons-no-alt"></span>
				</a>

                <!-- Header -->
                <div class="trendy-storefront-notice">
                    <div class="trendy-storefront-notice-title">
                        <h1><?php echo esc_html( $trendy_storefront_theme->get('Name') ); ?></h1>
                        <span>
                            <?php esc_html_e('Version', 'trendy-storefront'); ?>
                            <?php echo esc_html($trendy_storefront_version); ?>
                        </span>
                    </div>

                    <div class="trendy-storefront-notice-buttons">
                        <a href="<?php echo esc_url( admin_url( 'themes.php?page=trendy-storefront-info' ) ); ?>" target="_blank" class="button">
                            <?php esc_html_e('Get Started', 'trendy-storefront'); ?>
                        </a>
						
                        <a href="<?php echo esc_url('https://www.apexthemes.net/products/ecommerce-wordpress-theme/'); ?>" target="_blank" class="button button-primary">
                            <?php esc_html_e('Get Premium', 'trendy-storefront'); ?>
                        </a>

                        <a href="<?php echo esc_url('https://trial.apexthemes.net/trendy-storefront/'); ?>" target="_blank" class="button">
                            <?php esc_html_e('Live Demo', 'trendy-storefront'); ?>
                        </a>
                    </div>

					<div class="trendy-storefront-notice-logo">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/apex-logo.png' ); ?>" alt="<?php esc_attr_e( 'Theme Screenshot', 'trendy-storefront' ); ?>">
                    </div>
                </div>

            </div>

            <?php
        }
    }
}
add_action('admin_notices', 'trendy_storefront_admin_notice');

if( ! function_exists( 'trendy_storefront_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function trendy_storefront_update_admin_notice(){
    if ( isset( $_GET['trendy_storefront_admin_notice'] ) && $_GET['trendy_storefront_admin_notice'] = '1' ) {
        update_option( 'trendy_storefront_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'trendy_storefront_update_admin_notice' );


add_action('after_switch_theme', 'trendy_storefront_setup_options');
function trendy_storefront_setup_options () {
    update_option('trendy_storefront_admin_notice', FALSE );
}

function trendy_storefront_notice_styles() {
	wp_enqueue_style(
		'trendy-storefront-notice-function',
		get_stylesheet_directory_uri() . '/assets/css/notice-function.css',
		array(),
		'1.0.0'
	);
}
add_action( 'admin_enqueue_scripts', 'trendy_storefront_notice_styles' );

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );