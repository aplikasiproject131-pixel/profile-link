<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package trendy_storefront
 */

get_header();
?>

<div id="content-wrap" class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="error-404 not-found">
				<header class="page-header">
					<h3 class="title"><?php esc_html_e( '404', 'trendy-storefront' ); ?></h3>
					<h1 class="page-title"><?php esc_html_e( 'This is not the page you are looking for. ', 'trendy-storefront' ); ?></h1>
				</header>

				<div class="page-content">
					<p><?php esc_html_e( 'It appears that nothing was discovered here. Could you try a search or one of the sites below?', 'trendy-storefront' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</section>
		</main>
	</div>
</div>

<?php
get_footer();