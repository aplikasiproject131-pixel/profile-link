<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trendy_storefront
 */

?>
	</div>

	<footer id="colophon" class="site-footer">
		<div id="footer-widgets" class="container">
			<div class="row">

				<!-- Footer Column 1 - Sidebar 1 -->
				<div class="col-md-4">
					<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-2' ); ?>
					<?php else : ?>
						<section class="widget">
							<h2 class="widget-title"><?php _e( 'About Us', 'trendy-storefront' ); ?></h2>
							<p><?php _e( 'This is default About Us text. Customize this in your widgets area. We are a passionate team dedicated to delivering quality services and exceptional support to our customers every step of the way. With years of experience and a commitment to innovation, we strive to meet the unique needs of every client.', 'trendy-storefront' ); ?></p>
						</section>
					<?php endif; ?>
				</div>

				<!-- Footer Column 2 - Sidebar 2 -->
				<div class="col-md-4">
					<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-3' ); ?>
					<?php else : ?>
						<section class="widget">
							<h2 class="widget-title"><?php _e( 'Recent Posts', 'trendy-storefront' ); ?></h2>
							<ul>
								<?php
								$recent_posts = wp_get_recent_posts( array(
									'numberposts' => 3,
									'post_status' => 'publish',
								) );
								foreach ( $recent_posts as $post ) : ?>
									<li>
										<a href="<?php echo esc_url( get_permalink( $post['ID'] ) ); ?>">
											<?php echo esc_html( $post['post_title'] ); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</section>
					<?php endif; ?>
				</div>

				<!-- Footer Column 3 - Sidebar 3 -->
				<div class="col-md-4">
					<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-4' ); ?>
					<?php else : ?>
						<section class="widget">
							<h2 class="widget-title"><?php _e( 'Contact Info', 'trendy-storefront' ); ?></h2>
							<ul>
								<li><?php echo esc_html( 'Email: info@example.com', 'trendy-storefront' ); ?></li>
								<li><?php echo esc_html( 'Phone: +91-123-456-7890', 'trendy-storefront' ); ?></li>
								<li><?php echo esc_html( 'Address: 1234 Elm St, Springfield, IL, USA', 'trendy-storefront' ); ?></li>
							</ul>
						</section>
					<?php endif; ?>
				</div>

			</div>
		</div>

		<div class="site-info">
			<div class="container">
				<?php
					if ( ! get_theme_mod('trendy_storefront_copyright_option') ) {

						$trendy_storefront_theme_name  = wp_get_theme()->get('Name');
						$trendy_storefront_theme_uri   = wp_get_theme()->get('ThemeURI');
						$trendy_storefront_author_name = wp_get_theme()->get('Author');
						$trendy_storefront_author_uri  = wp_get_theme()->get('AuthorURI');
						?>

						<a target="_blank" href="<?php echo esc_url( $trendy_storefront_theme_uri ); ?>">
							<?php echo esc_html( $trendy_storefront_theme_name ); ?>
						</a>

						<?php echo esc_html(' By '); ?>

						<a target="_blank" href="<?php echo esc_url( $trendy_storefront_author_uri ); ?>">
							<?php echo esc_html( $trendy_storefront_author_name ); ?>
						</a>

					<?php
					} else {
						echo esc_html( get_theme_mod('trendy_storefront_copyright_option') );
					}
				?>
			</div>
		</div>
	</footer>

	<a href="#page" class="to-top"></a>
	
</div>

<?php wp_footer(); ?>

</body>
</html>
