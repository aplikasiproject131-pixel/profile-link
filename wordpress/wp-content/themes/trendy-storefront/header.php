<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trendy_storefront
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'trendy-storefront' ); ?></a>

	<?php if( is_front_page() || !is_paged() ) {
		get_template_part( 'apex-library/header', 'image' );
	} ?>

	<header id="masthead" class="site-header">
		<section id="top-header">
			<div class="container">
				<div class="row header-bg">
					<div class="col-xxl-2 col-xl-2 col-lg-3 col-md-6 col-sm-5 align-self-center">
						<div class="site-branding text-center text-md-start">
							<div class="site-branding-logo">
								<?php the_custom_logo(); ?>
							</div>

							<div class="site-branding-text">
								<?php if ( is_front_page() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php endif; ?>

								<?php
								$trendy_storefront_description = get_bloginfo( 'description', 'display' );

								if ( $trendy_storefront_description || is_customize_preview() ) :
									?>
									<p class="site-description"><?php echo esc_html( $trendy_storefront_description ); ?></p>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-xxl-5 col-xl-4 col-lg-9 col-md-6 col-sm-3 align-self-center text-md-start">
						<?php get_template_part('apex-library/template-parts/navigation'); ?>
					</div>
					<div class="col-xxl-5 col-xl-6 col-lg-12 col-md-12 col-sm-5 align-self-center text-md-end text-center header-details">
						<span class="header-product-search">
							<?php get_template_part( 'searchform', 'product' ); ?>
						</span>
		                <span class="currency me-md-2 mb-md-0 mb-2">
		                    <?php if (get_theme_mod('trendy_storefront_currency_switcher', true) && class_exists('WooCommerce')) : ?>
		                        <div class="currency-box">
		                            <?php echo wp_kses_post(do_shortcode('[woocommerce_currency_switcher_drop_down_box]')); ?>
		                        </div>
		                    <?php endif; ?>
		                </span>
		                <span class="translate-btn d-flex">
		                    <?php if (get_theme_mod('trendy_storefront_cart_language_translator', true) && class_exists('GTranslate')) : ?>
		                        <div class="translate-lang position-relative d-md-inline-block me-3">
		                            <?php echo wp_kses_post(do_shortcode('[gtranslate]')); ?>
		                        </div>
		                    <?php endif; ?>
		                </span>
						<span class="header-wislist detail-bg">
						    <?php if ( class_exists( 'YITH_WCWL' ) ) : ?>
						        <a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>">
						            <i class="bi bi-heart-fill" aria-hidden="true"></i>
						        </a>
						    <?php endif; ?> 	
						</span>

						<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						    <span class="product-cart text-center position-relative detail-bg">
						        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'Shopping cart', 'trendy-storefront' ); ?>">
						            <i class="bi bi-bag-dash-fill" aria-hidden="true"></i>
						        </a>

						        <?php 
						        $trendy_storefront_cart_count = WC()->cart->get_cart_contents_count(); 
						        if ( $trendy_storefront_cart_count > 0 ) : ?>
						            <span class="cart-count"><?php echo esc_html( $trendy_storefront_cart_count ); ?></span>
						        <?php endif; ?>
						    </span>
						<?php endif; ?>

						<?php if ( is_user_logged_in() ) : 
						    $current_user = wp_get_current_user();
						?>
						    <span class="admin-profile-image ms-2">
						        <a href="<?php echo esc_url( admin_url() ); ?>">
						            <?php echo get_avatar( $current_user->ID, 35 ); ?>
						        </a>
						    </span>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	</header>

	<div id="content" class="site-content">
