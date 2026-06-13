<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trendy_storefront
 */
?>

<aside id="secondary" class="widget-area">
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		<?php else : ?>
		<!-- Search Widget -->
		<section class="widget widget_search">
			<h2 class="widget-title"><?php _e( 'Search', 'trendy-storefront' ); ?></h2>
			<?php get_search_form(); ?>
		</section>
		<!-- Default Sidebar Content -->
		<section class="widget">
			<h2 class="widget-title"><?php _e( 'Archives', 'trendy-storefront' ); ?></h2>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</section>

		<section class="widget">
			<h2 class="widget-title"><?php _e( 'Recent Posts', 'trendy-storefront' ); ?></h2>
			<ul>
				<?php
				$recent_posts = wp_get_recent_posts( array(
					'numberposts' => 5,
					'post_status' => 'publish'
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

		<section class="widget">
			<h2 class="widget-title"><?php _e( 'Tags', 'trendy-storefront' ); ?></h2>
			<div class="tagcloud">
				<?php wp_tag_cloud(); ?>
			</div>
		</section>
	<?php endif; ?>
</aside>