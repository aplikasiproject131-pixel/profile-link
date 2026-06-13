/* global trendy_storefront_l10n */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

// Menus 
function trendy_storefront_menu_open_nav() {
    jQuery(".sidenav").addClass('show');
  }
  function trendy_storefront_menu_close_nav() {
    jQuery(".sidenav").removeClass('show');
  }
  
  ( function( window, document ) {
    function trendy_storefront_keepFocusInMenu() {
      document.addEventListener( 'keydown', function( e ) {
        const trendy_storefront_nav = document.querySelector( '.sidenav' );
  
        if ( ! trendy_storefront_nav || ! trendy_storefront_nav.classList.contains( 'show' ) ) {
          return;
        }
        const elements = [...trendy_storefront_nav.querySelectorAll( 'input, a, button' )],
          trendy_storefront_lastEl = elements[ elements.length - 1 ],
          trendy_storefront_firstEl = elements[0],
          trendy_storefront_activeEl = document.activeElement,
          tabKey = e.keyCode === 9,
          shiftKey = e.shiftKey;
  
        if ( ! shiftKey && tabKey && trendy_storefront_lastEl === trendy_storefront_activeEl ) {
          e.preventDefault();
          trendy_storefront_firstEl.focus();
        }
  
        if ( shiftKey && tabKey && trendy_storefront_firstEl === trendy_storefront_activeEl ) {
          e.preventDefault();
          trendy_storefront_lastEl.focus();
        }
      } );
    }
    trendy_storefront_keepFocusInMenu();
  } )( window, document );