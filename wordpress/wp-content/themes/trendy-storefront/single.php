<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package trendy_storefront
 */

get_header();
?>

<div class="box-image position-relative">
    <div class="single-page-img"></div>
    <div class="page-header">
        <h1><?php the_title();?></h1> 
        <span><?php trendy_storefront_the_breadcrumb(); ?></span>
    </div> 
</div>

<div id="content-wrap" class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="single-post-wrap">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'apex-library/template-parts/content', 'single' );

					the_post_navigation(
						array(
							'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'trendy-storefront' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'trendy-storefront' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . trendy_storefront_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
							'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'trendy-storefront' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'trendy-storefront' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . trendy_storefront_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
						)
					);

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div>
		</main>
	</div>

<?php get_sidebar(); ?>

</div>

<?php
get_footer();
