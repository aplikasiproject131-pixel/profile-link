<?php
/**
 * Get Started Page
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add menu under Appearance
function trendy_storefront_add_theme_info_page() {
    add_theme_page(
        esc_html__('Get Started', 'trendy-storefront'),
        esc_html__('Get Started', 'trendy-storefront'),
        'manage_options',
        'trendy-storefront-info',
        'trendy_storefront_render_theme_info_page'
    );
}
add_action('admin_menu', 'trendy_storefront_add_theme_info_page');


// Enqueue styles only on this page
function trendy_storefront_admin_assets($trendy_storefront_hook) {

    if ( $trendy_storefront_hook !== 'appearance_page_trendy-storefront-info' ) {
        return;
    }

    wp_enqueue_style(
        'trendy-storefront-theme-info',
        get_template_directory_uri() . '/assets/css/theme-info.css',
        array(),
        wp_get_theme()->get('Version')
    );
}
add_action('admin_enqueue_scripts', 'trendy_storefront_admin_assets');


// Render Page
function trendy_storefront_render_theme_info_page() {

    $trendy_storefront_theme = wp_get_theme();
    $trendy_storefront_version = $trendy_storefront_theme->get('Version');
    $trendy_storefront_import_completed = (bool) get_option( 'trendy_storefront_demo_import_completed', false );

    ?>
    <div class="wrap trendy-storefront-dashboard">
		<h1 class="main-head-hidden"><?php echo esc_html( $trendy_storefront_theme->get('Name') ); ?></h1>

        <!-- Header -->
        <div class="trendy-storefront-header">
            <div class="trendy-storefront-title">
                <h1><?php echo esc_html( $trendy_storefront_theme->get('Name') ); ?></h1>
                <span><?php esc_html_e('Version', 'trendy-storefront'); ?> <?php echo esc_html($trendy_storefront_version); ?></span>
            </div>

            <div class="trendy-storefront-header-buttons">
                <a href="<?php echo esc_url('https://www.apexthemes.net/products/ecommerce-wordpress-theme/'); ?>" target="_blank" rel="noopener noreferrer" class="btn-outline">
                    <?php esc_html_e('Get Premium', 'trendy-storefront'); ?>
                </a>
                <a href="<?php echo esc_url('https://trial.apexthemes.net/trendy-storefront/'); ?>" target="_blank" rel="noopener noreferrer" class="btn-outline">
                    <?php esc_html_e('Live Demo', 'trendy-storefront'); ?>
                </a>
                <a href="<?php echo esc_url('https://trial.apexthemes.net/docs/trendy-storefront-pro/'); ?>" target="_blank" rel="noopener noreferrer" class="btn-outline">
                    <?php esc_html_e('Documentation', 'trendy-storefront'); ?>
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="trendy-storefront-main">

            <!-- Left -->
            <div class="trendy-storefront-left">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>" alt="theme">

                <div class="trendy-storefront-buttons">
                    <a href="<?php echo esc_url('https://www.apexthemes.net/products/ecommerce-wordpress-theme/'); ?>" target="_blank" rel="noopener noreferrer" class="btn-gradient">
                        <?php esc_html_e('Get Premium', 'trendy-storefront'); ?>
                    </a>
                    <a href="<?php echo esc_url('https://trial.apexthemes.net/trendy-storefront/'); ?>" target="_blank" rel="noopener noreferrer" class="btn-gradient">
                        <?php esc_html_e('Live Demo', 'trendy-storefront'); ?>
                    </a>
                    <a href="<?php echo esc_url('https://trial.apexthemes.net/docs/trendy-storefront-pro/'); ?>" target="_blank" rel="noopener noreferrer" class="btn-gradient">
                        <?php esc_html_e('Documentation', 'trendy-storefront'); ?>
                    </a>
                </div>
            </div>

            <!-- Right -->
            <div class="trendy-storefront-right">

                <h2>
                    <?php echo esc_html($trendy_storefront_theme->get('Name')); ?>
                </h2>
                <div class="trendy-storefront-default-content">

                    <p>
                        <?php echo esc_html($trendy_storefront_theme->get('Description')); ?>
                    </p>

                    <?php if ( ! $trendy_storefront_import_completed ) : ?>
                        <a href="#" id="trendy-storefront-import-btn" class="btn-gradient">
                            <?php esc_html_e('Import Demo Now', 'trendy-storefront'); ?>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-gradient" target="_blank" rel="noopener noreferrer">
                            <?php esc_html_e('Visit Site', 'trendy-storefront'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="trendy-storefront-import-content">
                    <?php
                    require_once get_template_directory() . '/apex-library/dashboard/dashboard-contents.php';
                    
                    global $trendy_storefront_config;
                    
                    if ( class_exists( 'Trendy_Storefront_Whizzie' ) ) {
                        $trendy_storefront_wiz = new Trendy_Storefront_Whizzie( $trendy_storefront_config );
                    
                        // NOTE: Only render the wizard UI — NOT header/wrapper/tabs
                        $trendy_storefront_wiz->wizard_page();
                    }
                    ?>
                </div>
                    
			</div>

        </div>
    </div>
    <?php
}