<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trendy_storefront
 */

get_header();
?>

<div class="box-image position-relative">
    <div class="single-page-img"></div>
    <div class="page-header">
        <h1><?php esc_html_e( 'Home', 'trendy-storefront' ); ?></h1>
    </div>
    <span><?php trendy_storefront_the_breadcrumb(); ?></span>
</div>

<div id="content-wrap" class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="blog-archive columns-1 clear">
				<?php
				if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						get_template_part( 'apex-library/template-parts/content', get_post_type() );

					endwhile;

				else :

					get_template_part( 'apex-library/template-parts/content', 'none' );

				endif;
				?>
			</div>

			<?php
			the_posts_pagination(
				array(
					'prev_text'          => trendy_storefront_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'trendy-storefront' ) . '</span>',
					'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'trendy-storefront' ) . '</span>' . trendy_storefront_get_svg( array( 'icon' => 'arrow-right' ) ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'trendy-storefront' ) . ' </span>',
				)
			); ?>
		</main>
	</div>

<?php get_sidebar(); ?>

</div>

<?php
get_footer();