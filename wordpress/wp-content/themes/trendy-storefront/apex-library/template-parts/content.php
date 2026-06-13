<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trendy_storefront
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-post-item">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="featured-image">
				<?php trendy_storefront_post_thumbnail(); ?>
			</div>
		<?php endif; ?>
    
        <div class="entry-container">
        	<div class="entry-meta">
        		<?php trendy_storefront_entry_footer(); ?>
				<?php trendy_storefront_posted_on(); ?>
        	</div>
	
			<header class="entry-header">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif; ?>
			</header>

			<?php $trendy_storefront_excerpt = get_the_excerpt();
			if ( !empty($trendy_storefront_excerpt) ) { ?>
				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div>
			<?php } ?>

			<?php $trendy_storefront_read_more_label = get_theme_mod( 'read_more_label' , 'Read More' );
			if ( !empty($trendy_storefront_read_more_label) ) { ?>
				<div class="read-more">
					<a href="<?php the_permalink(); ?>"><?php echo esc_html($trendy_storefront_read_more_label);?></a>
				</div>
			<?php } ?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->