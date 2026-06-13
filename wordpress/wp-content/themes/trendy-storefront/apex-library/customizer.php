<?php
/**
 * Trendy Storefront Theme Customizer
 *
 * @package trendy_storefront
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function trendy_storefront_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Load sanitize functions.
	include get_template_directory() . '/apex-library/sanitize.php';

	// Load header options.
	include get_template_directory() . '/apex-library/header-options.php';

	// Load home options.
	include get_template_directory() . '/apex-library/home-options.php';

	// Load theme options.
	include get_template_directory() . '/apex-library/theme-options.php';

	// Load footer options.
	include get_template_directory() . '/apex-library/footer-options.php';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'trendy_storefront_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'trendy_storefront_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'trendy_storefront_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function trendy_storefront_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function trendy_storefront_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function trendy_storefront_customize_preview_js() {
	wp_enqueue_script( 'trendy-storefront-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'trendy_storefront_customize_preview_js' );


/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Trendy_Storefront_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $trendy_storefront_instance = null;

		if ( is_null( $trendy_storefront_instance ) ) {
			$trendy_storefront_instance = new self;
			$trendy_storefront_instance->setup_actions();
		}

		return $trendy_storefront_instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/apex-library/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Trendy_Storefront_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new Trendy_Storefront_Customize_Section_Pro( $manager,'trendy_storefront_go_pro', array(
			'priority'   => 1,
			'title'    => esc_html__( 'Trendy Storefront Pro', 'trendy-storefront' ),
			'pro_text' => esc_html__( 'Buy Pro', 'trendy-storefront' ),
			'pro_url'    => 'https://www.apexthemes.net/products/ecommerce-wordpress-theme/'
		) )	);

	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'trendy-storefront-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'trendy-storefront-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Trendy_Storefront_Customize::get_instance();