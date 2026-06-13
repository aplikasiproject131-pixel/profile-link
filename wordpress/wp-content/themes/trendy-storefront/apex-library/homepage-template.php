<?php
/**
 * Template Name: Home Page Template
 */

get_header();

$trendy_storefront_slider_hide = get_theme_mod('trendy_storefront_slider_hide', false);
$trendy_storefront_featured_post_heading = get_theme_mod('trendy_storefront_featured_post_heading', 'FEATURED POST');
$trendy_storefront_featured_post_hide = get_theme_mod('trendy_storefront_new_arrivals_hide', false);
?>

<main id="main" class="site-main">
	<?php if ($trendy_storefront_slider_hide && class_exists( 'WooCommerce' )) { ?>
		<section class="homepage-temp">
			<div class="container p-0">
			<div class="row">
	            <div class="col-lg-9 col-md-8 slider-left">
	            	<?php
					$trendy_storefront_catData = get_theme_mod('trendy_storefront_slider_categories_setting','product_cat4');
					if ($trendy_storefront_catData && $trendy_storefront_catData != '0') { ?>
					    <div class="owl-carousel m-0">
					        <?php
					            $trendy_storefront_page_query = new WP_Query(
					                array(
					                    'post_type' => 'product',
					                    'posts_per_page' => 3,
					                    'tax_query' => array(
					                        array(
					                            'taxonomy' => 'product_cat',
					                            'field'    => 'slug',
					                            'terms'    => esc_attr($trendy_storefront_catData),
					                        ),
					                    ),
					                )
					            );
					            while ($trendy_storefront_page_query->have_posts()) : $trendy_storefront_page_query->the_post();
					            	global $product; ?>
					                <div class="slider-news-main">
					                	<div class="row">
					                		<div class="col-lg-8 col-md-8">
							                    <div class="slider-news-content">
								                    <?php if (get_theme_mod('trendy_storefront_product_sub_heading')) { ?>
								                        <p class="product-sec-text mb-0 text-capitalize"><?php echo esc_html(get_theme_mod('trendy_storefront_product_sub_heading')); ?></p>
								                    <?php } ?>
								                    <?php if (get_theme_mod('trendy_storefront_product_heading')) { ?>
								                        <h1 class="product-sec-text mb-0"><?php echo esc_html(get_theme_mod('trendy_storefront_product_heading')); ?></h1>
								                    <?php } ?>

													<div class="metas-divs">
														<?php 
															$product_categories = get_the_terms( get_the_ID(), 'product_cat' );
															if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) {
																echo '<div class="slider-post-categories mb-0">';
																$count = 0;
																foreach ( $product_categories as $category ) {
																	if ( $count >= 2 ) break;
																	echo '<a href="' . esc_url( get_term_link( $category->term_id ) ) . '" class="badge me-1 text-decoration-none">' . esc_html( $category->name ) . '</a>';
																	$count++;
																}
																echo '</div>';
															}
														?>
														<h4 class="slider-title mb-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
														<p class="prod-price mb-3">
															<i class="bi bi-tag"></i> 
															<?php echo esc_html('Price: ','trendy-storefront'); ?> 
															<?php echo $product->get_price_html(); ?>
														</p>
													</div>

					                                <div class="slider-btn mt-3">
					                                	<a href="<?php the_permalink(); ?>" class="btn btn-primary">
					                                		<?php echo esc_html__('Shop Now', 'trendy-storefront'); ?> <i class="bi bi-lock-fill ms-2"></i>
					                                	</a>
					                                </div>
							                    </div>
					                		</div>
					                		<div class="col-lg-4 col-md-4">
						                		<div class="slider-news-image">
					                				<?php if(has_post_thumbnail()){
							                            the_post_thumbnail('full', array('class' => 'post-image'));
							                        } else { ?>
							                            <img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" alt="<?php echo esc_attr( 'product', 'trendy-storefront'); ?>"/>
							                        <?php } ?>
						                		</div>
					                		</div>
					                	</div>
					                </div>
					            <?php endwhile;
					            wp_reset_postdata();
					        ?>
					    </div>
					<?php } ?>



					<?php if(get_theme_mod('trendy_storefront_slider_boxes_hide')){ ?>

						<div class="slider-boxxes mt-4">
							<div class="row">

								<!-- BOX 1 -->
								<div class="col-lg-4">
									<div class="slider-inner-box slider-box-one">
										
										<div class="sliderinn-img">
											<img src="<?php echo esc_url(get_theme_mod('trendy_storefront_slider_box1_image')); ?>">
										</div>

										<div class="sliderinn-cont">
											<p class="mb-0"><?php echo esc_html(get_theme_mod('trendy_storefront_slider_box1_title')); ?></p>
											<h5><?php echo esc_html(get_theme_mod('trendy_storefront_slider_box1_text')); ?></h5>

											<div class="slider-btn mt-3">
												<a href="<?php echo esc_url(get_theme_mod('trendy_storefront_slider_box1_link')); ?>" class="btn btn-primary">
													<?php echo esc_html(get_theme_mod('trendy_storefront_slider_box1_btn')); ?> <i class="bi bi-lock-fill ms-2"></i>
												</a>
											</div>
										</div>

									</div>
								</div>


								<!-- BOX 2 -->
								<div class="col-lg-4">
									<div class="slider-inner-box review-box slider-box-two">

										<div class="review-top">
											<div class="review-users">
												<img src="<?php echo esc_url(get_theme_mod('trendy_storefront_review_img1')); ?>">
												<img src="<?php echo esc_url(get_theme_mod('trendy_storefront_review_img2')); ?>">
												<img src="<?php echo esc_url(get_theme_mod('trendy_storefront_review_img3')); ?>">
												<img src="<?php echo esc_url(get_theme_mod('trendy_storefront_review_img4')); ?>">
											</div>

											<h4><?php echo esc_html(get_theme_mod('trendy_storefront_review_number')); ?></h4>
											<span><?php echo esc_html(get_theme_mod('trendy_storefront_review_label')); ?></span>

											<div class="review-stars">
												<?php
												$rating = absint( get_theme_mod( 'trendy_storefront_review_rating', 5 ) );

												echo esc_html( str_repeat( '★', $rating ) );
												echo esc_html( str_repeat( '☆', 5 - $rating ) );
												?>
											</div>
										</div>

										<div class="review-content">
											<p><?php echo esc_html(get_theme_mod('trendy_storefront_review_text')); ?></p>
										</div>

									</div>
								</div>


								<!-- BOX 3 -->
								<div class="col-lg-4">
									<div class="slider-inner-box slider-box-three">

										<div class="sliderinn-cont">
											<p class="mb-0"><?php echo esc_html(get_theme_mod('trendy_storefront_slider_box3_title')); ?></p>
											<h5><?php echo esc_html(get_theme_mod('trendy_storefront_slider_box3_text')); ?></h5>

											<div class="slider-btn mt-3">
												<a href="<?php echo esc_url(get_theme_mod('trendy_storefront_slider_box3_link')); ?>" class="btn btn-primary">
													<?php echo esc_html(get_theme_mod('trendy_storefront_slider_box3_btn')); ?> <i class="bi bi-lock-fill ms-2"></i>
												</a>
											</div>
										</div>

										<div class="sliderinn-img">
											<img src="<?php echo esc_url(get_theme_mod('trendy_storefront_slider_box3_image')); ?>">
										</div>

									</div>
								</div>

							</div>
						</div>

					<?php } ?>
	            </div>
	            <div class="col-lg-3 col-md-4 ">
					<?php if ($trendy_storefront_slider_hide) { 
						// Get all product categories for dropdown
						$product_categories = get_terms( array(
							'taxonomy'   => 'product_cat',
							'hide_empty' => true,
						) );
						
						$trendy_storefront_catData = get_theme_mod('trendy_storefront_slider_categories_right_setting');
						$default_category = ($trendy_storefront_catData && $trendy_storefront_catData != '0') ? $trendy_storefront_catData : '';
						
						if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) { ?>
							<div class="right-post">
								
								<?php
								// Load initial categories (first 5 like screenshot)
								$initial_categories = get_terms( array(
									'taxonomy'   => 'product_cat',
									'hide_empty' => true,
									'number'     => 5,
									'orderby'    => 'name',
								) );
								
								if ( ! empty( $initial_categories ) && ! is_wp_error( $initial_categories ) ) {
									foreach ( $initial_categories as $category ) {
										$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
										$image_url = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'thumbnail' ) : wc_placeholder_img_src();
										$category_link = get_term_link( $category->term_id, 'product_cat' );
										?>
										<div class="slider-cat-main row align-items-center mb-4">
											<div class="slider-cat-news-image col-lg-5 col-5 position-relative">
												<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $category->name ); ?>" class="prod-cat-image w-100" />
											</div>
											<div class="slider-news-content col-lg-7 col-7">
												<h5 class="slider-cat-title mb-0">
													<a href="<?php echo esc_url( $category_link ); ?>"><?php echo esc_html( $category->name ); ?></a>
												</h1>
												<div class="meta-box">
													<p class="prod-counts mb-2">
														<?php echo esc_html( $category->count ); ?> <?php echo esc_html__('Product Available', 'trendy-storefront'); ?>
													</p>
												</div>
											</div>
										</div>
										<?php
									}
								} else { ?>
									<p class="no-products-msg"><?php echo esc_html__('No categories found.', 'trendy-storefront'); ?></p>
								<?php } ?>
								
								<!-- See All Category Button -->
								<div class="see-all-category text-center mt-5">
									<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-primary">
										<?php echo esc_html__('See All Category', 'trendy-storefront'); ?> <i class="bi bi-lock-fill ms-2"></i>
									</a>
								</div>
							</div>
						<?php }
					} ?>
				</div>

	        </div>	
			</div>
		</section>
	<?php } ?>
	<?php if ($trendy_storefront_featured_post_hide) { ?>
        <section id="product-section" class="py-2 mb-5 mt-lg-5">
            <div class="container pro-bg">
                <div class="blog-bx mb-0 text-left">
                    <?php if (get_theme_mod('trendy_storefront_product_sec_title')) { ?>
                        <h2 class="product-sec-title m-0 text-capitalize"><?php echo esc_html(get_theme_mod('trendy_storefront_product_sec_title')); ?></h2>
                    <?php } ?>
                    <?php if (get_theme_mod('trendy_storefront_product_sec_text')) { ?>
                        <p class="product-sec-text mb-0 text-capitalize"><?php echo esc_html(get_theme_mod('trendy_storefront_product_sec_text')); ?></p>
                    <?php } ?>
                </div>
					<div class="row">
						<?php 
						if ( class_exists( 'WooCommerce' ) ) {

						    $trendy_storefront_args = array(
						        'post_type'      => 'product',
						        'posts_per_page' => 8,
						        'orderby'        => 'date',
						        'order'          => 'DESC',
						        'post_status'    => 'publish'
						    );

						    $trendy_storefront_loop = new WP_Query( $trendy_storefront_args );

						    if ( $trendy_storefront_loop->have_posts() ) {
						?>
						        <div class="owl-carousel trendy-storefront-new-arrivals">
						        <?php
						        while ( $trendy_storefront_loop->have_posts() ) : $trendy_storefront_loop->the_post(); 
						            global $product;
						        ?>
						            <div class="item product-main-box mb-3 text-center">
						                <div class="product-box position-relative">

						                    <!-- Product Image -->
						                    <div class="product-box-img text-center pb-2 mb-2">
						                        <?php 
						                        if ( has_post_thumbnail() ) {
						                            echo get_the_post_thumbnail( get_the_ID(), 'shop_catalog', array( 'class' => 'product-img' ) );
						                        } else {
						                            echo '<img class="product-img" src="' . esc_url( wc_placeholder_img_src() ) . '" />';
						                        }
						                        ?>
						                    </div>

						                    <div class="product-box-content text-start">

												<div class="produvt-cat-rat mb-1">

													<!-- Category Name -->
													<p class="product-category mb-0">
														<?php
														$terms = get_the_terms( get_the_ID(), 'product_cat' );
														if ( $terms && ! is_wp_error( $terms ) ) {
															echo esc_html( $terms[0]->name );
														}
														?>

														
													</p>

													<p class="product-ratings mb-0 ">
														<span class=" me-1">
															<?php 
																$rating_count = $product->get_rating_count();
																$average = $product->get_average_rating();
																echo $average > 0 ? number_format($average, 1) : esc_html__('No rating', 'trendy-storefront');
															?>
														</span>
														<i class="bi bi-star-fill"></i>
													</p>
													
												</div>
						                        

												


						                        <!-- Product Title -->
						                        <h3 class="pro-title text-capitalize">
						                            <a href="<?php echo esc_url( get_permalink() ); ?>">
						                                <?php the_title(); ?>
						                            </a>
						                        </h3>

						                        <!-- Short Description -->
						                        <p class="product-short-desc mb-2">
						                            <?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 15 ) ); ?>
						                        </p>

						                    </div>
						                </div>

						                <!-- Add to Cart Button -->
						                <div class="product-btn text-start">
											<?php
											echo apply_filters(
											    'woocommerce_loop_add_to_cart_link',
											    sprintf(
											        '<a href="%s" data-quantity="1" class="button add_to_cart_button ajax_add_to_cart d-inline-flex align-items-center" data-product_id="%s" data-product_sku="%s" aria-label="%s">%s<i class="bi bi-bag-dash-fill me-2"></i>
											        </a>',
											        esc_url( $product->add_to_cart_url() ),
											        esc_attr( $product->get_id() ),
											        esc_attr( $product->get_sku() ),
											        esc_attr( $product->add_to_cart_description() ),
											        esc_html__( 'Add to Bag', 'trendy-storefront' )
											    ),
											    $product
											);
											?>
						                </div>
						            </div>

						        <?php
						        endwhile;
						        ?>
						        </div>
						<?php
						        wp_reset_postdata();
						    }
						}
						?>
					</div>
            </div>
        </section>
	<?php } ?>
</main>
<?php
get_footer();