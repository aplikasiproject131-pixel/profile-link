<?php
/**
 * The template for displaying archive pages
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
    <?php
      the_archive_title( '<h1 class="entry-title">', '</h1>' );
      the_archive_description( '<div class="taxonomy-description">', '</div>' );
    ?>
     <span><?php trendy_storefront_the_breadcrumb(); ?></span>
  </div>
</div>

<div id="content-wrap" class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">					
			<div class="blog-archive columns-1 clear">
				<?php if ( have_posts() ) : ?>
					<?php
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
