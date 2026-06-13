<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
        <h1><?php the_title();?></h1> 
        <span class="page-breadrumb"><?php trendy_storefront_the_breadcrumb(); ?></span> 
    </div>
</div>

<div id="content-wrap" class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="single-page-wrapper">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'apex-library/template-parts/content', 'page' );

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
