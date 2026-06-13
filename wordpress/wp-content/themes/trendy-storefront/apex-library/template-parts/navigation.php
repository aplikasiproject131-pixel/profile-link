<?php
/**
 * The template part for header
 *
 * @package Trendy Storefront 
 * @subpackage trendy-storefront
 * @since trendy-storefront 1.0
 */
?>

<div class="navigation_header">
  <div class="toggle-nav mobile-menu">
    <button onclick="trendy_storefront_menu_open_nav()"><i class="fa-solid fa-bars"></i></button>
  </div>
  <div id="mySidenav" class="nav sidenav">
    <nav id="site-navigation" class="main-navigation navbar navbar-expand-xl" aria-label="<?php esc_attr_e( 'Top Menu', 'trendy-storefront' ); ?>">
      <?php {
        wp_nav_menu(
          array(
            'theme_location' => 'primary_menu',
            'menu_class'     => 'menu', 
            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'fallback_cb' => 'wp_page_menu',
          )
        );
      } ?>
    </nav>
    <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="trendy_storefront_menu_close_nav()"><i class="fas fa-times"></i></a>
  </div>
</div>