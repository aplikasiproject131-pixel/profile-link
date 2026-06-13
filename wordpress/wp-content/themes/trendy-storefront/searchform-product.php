<?php
/**
 * The search template file
 *
 * @package trendy_storefront
 */

?>

<form method="get"
      class="woocommerce-product-search"
      action="<?php echo esc_url( home_url( '/' ) ); ?>">

    <label class="screen-reader-text" for="header-product-search-field">
        <?php echo esc_html__( 'Search for:', 'trendy-storefront' ); ?>
    </label>

    <input type="search"
           id="header-product-search-field"
           class="search-field"
           placeholder="<?php echo esc_attr__( 'Search products…', 'trendy-storefront' ); ?>"
           value="<?php echo esc_attr( get_search_query() ); ?>"
           name="s" />

    <input type="hidden" name="post_type" value="product" />

    <button type="submit" class="search-submit">
        <span class="screen-reader-text">
            <?php echo esc_html__( 'Search', 'trendy-storefront' ); ?>
        </span>
        <i class="bi bi-search" aria-hidden="true"></i>
    </button>

</form>