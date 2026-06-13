<?php //to use wp udpate plugin
  $trendy_storefront_home_id=''; $trendy_storefront_blog_id=''; $trendy_storefront_page_id=''; $trendy_storefront_about_id='';


  // Function to check if a page with a specific title exists
  function page_exists_by_title($trendy_storefront_title) {
    $page_query = new WP_Query(array(
        'post_type'   => 'page',
        'title'       => $trendy_storefront_title,
        'post_status' => 'publish',
        'numberposts' => 1
    ));
    
    if ($page_query->have_posts()) {
        // Return the ID of the first matching page
        $page = $page_query->posts[0];
        return $page->ID;
    }
  
    return false; // Return false if no page found
  }

  //Homepage
  $trendy_storefront_home_title = 'Home';
  if (!page_exists_by_title($trendy_storefront_home_title)) {
    $trendy_storefront_home_content = '';
    $trendy_storefront_home = array(
      'post_type'    => 'page',
      'post_title'   => $trendy_storefront_home_title,
      'post_content' => $trendy_storefront_home_content,
      'post_status'  => 'publish',
      'post_author'  => 1,
      'post_name'    => 'home'
    );

    $trendy_storefront_home_id = wp_insert_post($trendy_storefront_home);
    
    // Set the home page template
    add_post_meta($trendy_storefront_home_id, '_wp_page_template', 'apex-library/homepage-template.php');
    
    // Set the static front page
    update_option('page_on_front', $trendy_storefront_home_id);
    update_option('show_on_front', 'page');

  }else {
    // Get the ID of the existing page
    $trendy_storefront_home_id = page_exists_by_title($trendy_storefront_home_title);

    // Set the home page template
    add_post_meta($trendy_storefront_home_id, '_wp_page_template', 'apex-library/homepage-template.php');
    
    // Set the static front page
    update_option('page_on_front', $trendy_storefront_home_id);
    update_option('show_on_front', 'page');
  }

  // Create a posts page and assign the template
  $trendy_storefront_blog_title = 'Blog';
  $trendy_storefront_blog_check = get_page_by_path('blog');
  if (!$trendy_storefront_blog_check) {
    $trendy_storefront_blog = array(
      'post_type'    => 'page',
      'post_title'   => $trendy_storefront_blog_title,
      'post_status'  => 'publish',
      'post_author'  => 1,
      'post_name'    => 'blog' // Unique slug for the blog page
    );
    $trendy_storefront_blog_id = wp_insert_post($trendy_storefront_blog);

    // Set the posts page
    if (!is_wp_error($trendy_storefront_blog_id)) {
      update_option('page_for_posts', $trendy_storefront_blog_id);
    }
  }
  
  // Create a Page if it doesn't exist
  if ( !page_exists_by_title('Page') ) {
    $trendy_storefront_page_title = 'Page';
    $trendy_storefront_content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel';

    $trendy_storefront_ot_page = array(
      'post_type'     => 'page',
      'post_title'    => $trendy_storefront_page_title,
      'post_content'  => $trendy_storefront_content,
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_name'     => 'page'
    );
    $trendy_storefront_page_id = wp_insert_post($trendy_storefront_ot_page);
  }else {
    // Get the ID of the existing page
    $trendy_storefront_ot_page = page_exists_by_title('Page');
  }

  // Create a About if it doesn't exist
  if ( !page_exists_by_title('About') ) {
    $trendy_storefront_page_title = 'About';
    $trendy_storefront_content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel';

    $trendy_storefront_ot_page = array(
      'post_type'     => 'page',
      'post_title'    => $trendy_storefront_page_title,
      'post_content'  => $trendy_storefront_content,
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_name'     => 'about'
    );
    $trendy_storefront_page_id = wp_insert_post($trendy_storefront_ot_page);
  }else {
    // Get the ID of the existing page
    $trendy_storefront_ot_page = page_exists_by_title('About');
  }

  // Create a Services if it doesn't exist
  if ( !page_exists_by_title('Services') ) {
    $trendy_storefront_page_title = 'Services';
    $trendy_storefront_content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel';

    $trendy_storefront_ot_page = array(
      'post_type'     => 'page',
      'post_title'    => $trendy_storefront_page_title,
      'post_content'  => $trendy_storefront_content,
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_name'     => 'services'
    );
    $trendy_storefront_page_id = wp_insert_post($trendy_storefront_ot_page);
  }else {
    // Get the ID of the existing page
    $trendy_storefront_ot_page = page_exists_by_title('Services');
  }

  // Create a Contact if it doesn't exist
  if ( !page_exists_by_title('Contact') ) {
    $trendy_storefront_page_title = 'Contact';
    $trendy_storefront_content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel';

    $trendy_storefront_ot_page = array(
      'post_type'     => 'page',
      'post_title'    => $trendy_storefront_page_title,
      'post_content'  => $trendy_storefront_content,
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_name'     => 'contact'
    );
    $trendy_storefront_page_id = wp_insert_post($trendy_storefront_ot_page);
  }else {
    // Get the ID of the existing page
    $trendy_storefront_ot_page = page_exists_by_title('Contact');
  }

  if ( !page_exists_by_title('Submenu Page One') ) {
    $trendy_storefront_page_title = 'Submenu Page One';
    $trendy_storefront_content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semelTe obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel.Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel.';

    $trendy_storefront_ot_page = array(
      'post_type'     => 'page',
      'post_title'    => $trendy_storefront_page_title,
      'post_content'  => $trendy_storefront_content,
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_name'     => 'submenu-page-one'
    );
    $trendy_storefront_page_id = wp_insert_post($trendy_storefront_ot_page);

    // Set the page template
    add_post_meta($trendy_storefront_page_id, '_wp_page_template', 'apex-library/left-sidebar.php');
  }else {
    // Get the ID of the existing page
    $trendy_storefront_ot_page = page_exists_by_title('Submenu Page One');
  }

  if ( !page_exists_by_title('Subemenu Page Two') ) {
    $trendy_storefront_page_title = 'Subemenu Page Two';
    $trendy_storefront_content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semelTe obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel.Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel.';

    $trendy_storefront_ot_page = array(
      'post_type'     => 'page',
      'post_title'    => $trendy_storefront_page_title,
      'post_content'  => $trendy_storefront_content,
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_name'     => 'submenu-page-two'
    );
    $trendy_storefront_page_id = wp_insert_post($trendy_storefront_ot_page);

    // Set the page template
    add_post_meta($trendy_storefront_page_id, '_wp_page_template', 'apex-library/right-sidebar.php');
    }else {
      // Get the ID of the existing page
      $trendy_storefront_ot_page = page_exists_by_title('Subemenu Page Two');
    }


  // ------- Create Left Menu --------
  $trendy_storefront_menuname =  'Main Menu';
  $trendy_storefront_bpmenulocation = 'primary_menu';
  $trendy_storefront_menu_exists = wp_get_nav_menu_object( $trendy_storefront_menuname );

  if (!$trendy_storefront_menu_exists) {
    // Create the menu
    $trendy_storefront_menu_id = wp_create_nav_menu($trendy_storefront_menuname);

    // Add the HOME item
    wp_update_nav_menu_item($trendy_storefront_menu_id, 0, array(
        'menu-item-title'  => __('Home', 'trendy-storefront'),
        'menu-item-classes' => 'home',
        'menu-item-url'     => home_url('/index.php/home/'),
        'menu-item-status'  => 'publish'
    ));

    // Add the PAGE item
    $parent_page_item_id = wp_update_nav_menu_item($trendy_storefront_menu_id, 0, array(
        'menu-item-title'  => __('Blogs', 'trendy-storefront'),
        'menu-item-classes' => 'blog',
        'menu-item-url'     => home_url('/index.php/blog/'),
        'menu-item-status'  => 'publish'
    ));

    // Add the PAGE item
    $parent_page_item_id = wp_update_nav_menu_item($trendy_storefront_menu_id, 0, array(
        'menu-item-title'  => __('Pages', 'trendy-storefront'),
        'menu-item-classes' => 'page',
        'menu-item-url'     => home_url('/index.php/page/'),
        'menu-item-status'  => 'publish'
    ));

    // Add the Submenu Page One item as a child of PAGE
    wp_update_nav_menu_item($trendy_storefront_menu_id, 0, array(
        'menu-item-title'   => __('Submenu Page One', 'trendy-storefront'),
        'menu-item-classes' => 'submenu-page-one',
        'menu-item-url'     => home_url('/index.php/submenu-page-one/'),
        'menu-item-status'  => 'publish',
        'menu-item-parent-id' => $parent_page_item_id
    ));

    // Add the Submenu Page Two item as a child of PAGE
    wp_update_nav_menu_item($trendy_storefront_menu_id, 0, array(
        'menu-item-title'   => __('Submenu Page Two', 'trendy-storefront'),
        'menu-item-classes' => 'submenu-page-two',
        'menu-item-url'     => home_url('/index.php/submenu-page-two/'),
        'menu-item-status'  => 'publish',
        'menu-item-parent-id' => $parent_page_item_id
    ));

    wp_update_nav_menu_item($trendy_storefront_menu_id, 0, array(
        'menu-item-title'  => __('About', 'trendy-storefront'),
        'menu-item-classes' => 'about',
        'menu-item-url'     => home_url('/index.php/about/'),
        'menu-item-status'  => 'publish'
    ));

    wp_update_nav_menu_item($trendy_storefront_menu_id, 0, array(
        'menu-item-title'  => __('Services', 'trendy-storefront'),
        'menu-item-classes' => 'services',
        'menu-item-url'     => home_url('/index.php/services/'),
        'menu-item-status'  => 'publish'
    ));

    wp_update_nav_menu_item($trendy_storefront_menu_id, 0, array(
        'menu-item-title'  => __('Contact', 'trendy-storefront'),
        'menu-item-classes' => 'contact',
        'menu-item-url'     => home_url('/index.php/contact/'),
        'menu-item-status'  => 'publish'
    ));
    
    // Assign the menu to the desired location if not already assigned
    if (!has_nav_menu($trendy_storefront_bpmenulocation)) {
        $trendy_storefront_locations = get_theme_mod('nav_menu_locations');
        $trendy_storefront_locations[$trendy_storefront_bpmenulocation] = $trendy_storefront_menu_id;
        set_theme_mod('nav_menu_locations', $trendy_storefront_locations);
    }
  }
     
  // --------Header------------------------

    set_theme_mod( 'trendy_storefront_currency_switcher', true );
    set_theme_mod( 'trendy_storefront_cart_language_translator', true );
    set_theme_mod( 'trendy_storefront_slider_hide', true );
    set_theme_mod( 'trendy_storefront_new_arrivals_hide', true );
    set_theme_mod( 'trendy_storefront_slider_boxes_hide', true );

    set_theme_mod( 'trendy_storefront_product_heading', 'Make your shopping experience smarter by shopping smarter.' ); 
    set_theme_mod( 'trendy_storefront_product_sub_heading', 'Get 20% In Every Product' ); 

    set_theme_mod( 'trendy_storefront_product_sec_title', 'New Arrival' );
    set_theme_mod( 'trendy_storefront_product_sec_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' );

    set_theme_mod( 'trendy_storefront_slider_box1_title', 'Buy Now $8500' );
    set_theme_mod( 'trendy_storefront_slider_box1_text', 'New Generation iPhone 15 Pro Max' );
    set_theme_mod( 'trendy_storefront_slider_box1_btn', 'Shop Now' );
    set_theme_mod( 'trendy_storefront_slider_box1_link', '#' );
    set_theme_mod( 'trendy_storefront_slider_box1_image',get_template_directory_uri().'/assets/images/mobile.png' );

    set_theme_mod( 'trendy_storefront_review_img1',get_template_directory_uri().'/assets/images/rev1.png' );
    set_theme_mod( 'trendy_storefront_review_img2',get_template_directory_uri().'/assets/images/rev2.png' );
    set_theme_mod( 'trendy_storefront_review_img3',get_template_directory_uri().'/assets/images/rev3.png' );
    set_theme_mod( 'trendy_storefront_review_img4',get_template_directory_uri().'/assets/images/rev4.png' );

    set_theme_mod( 'trendy_storefront_review_number', '80k+' );
    set_theme_mod( 'trendy_storefront_review_label', 'Product Reviews' );

    set_theme_mod( 'trendy_storefront_review_text', 'Our customers say it best! Browse genuine reviews and discover why people love our products — from quality and style to unbeatable prices and fast shipping, satisfaction speaks for itself.' );
    set_theme_mod( 'trendy_storefront_review_rating', 5 );

    set_theme_mod( 'trendy_storefront_slider_box3_title', 'Buy Now $8500' );
    set_theme_mod( 'trendy_storefront_slider_box3_text', 'iWatch New Generation Z\'s Series' );
    set_theme_mod( 'trendy_storefront_slider_box3_btn', 'Shop Now' );
    set_theme_mod( 'trendy_storefront_slider_box3_link', '#' );
    set_theme_mod( 'trendy_storefront_slider_box3_image',get_template_directory_uri().'/assets/images/watch.png' );

  //-------------- Products ----------------------

  $trendy_storefront_product_category= array(
    'Camera' => array(
          'SnapMaster Pro',
    ),
    'Laptop' => array(
          'ZenLite Notebook',
    ),
    'Refrigerator' => array(
          'BoomBox Xtreme',
    ),
    'Smart Watch' => array(
          'GalaxyCore Ultra',
          'Noise Smart Watch',
    ),
    'Speaker' => array(
          'EchoTune Max',
    ),
  );
  $k = 1;
  foreach ( $trendy_storefront_product_category as $trendy_storefront_product_cats => $trendy_storefront_products_name ) {

    // Insert porduct cats Start
    $content = 'Lorem ipsum dolor sit amet';
    $parent_category	=	wp_insert_term(
    $trendy_storefront_product_cats, // the term
    'product_cat', // the taxonomy
    array(
      'description'=> $content,
      'slug' => 'product_cat'.$k
    ));

    $image_url = get_template_directory_uri().'/assets/images/categories'.$k.'.png';

    $trendy_storefront_image_name= 'img'.$k.'.png';
    $upload_dir       = wp_upload_dir();
    // Set upload folder
    $trendy_storefront_image_data= file_get_contents($image_url);
    // Get image data
    $unique_file_name = wp_unique_filename( $upload_dir['path'], $trendy_storefront_image_name );
    // Generate unique name
    $filename= basename( $unique_file_name );
    // Create image file name

    // Check folder permission and define file location
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
    $file = $upload_dir['path'] . '/' . $filename;
    } else {
    $file = $upload_dir['basedir'] . '/' . $filename;
    }

    // Create the image  file on the server
    if ( ! function_exists( 'WP_Filesystem' ) ) {
      require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }
    
    WP_Filesystem();
    global $wp_filesystem;
    
    if ( ! $wp_filesystem->put_contents( $file, $trendy_storefront_image_data, FS_CHMOD_FILE ) ) {
      wp_die( 'Error saving file!' );
    }
    
    // Check image file type
    $wp_filetype = wp_check_filetype( $filename, null );

    // Set attachment data
    $attachment = array(
    'post_mime_type' => $wp_filetype['type'],
    'post_title'     => sanitize_file_name( $filename ),
    'post_content'   => '',
    'post_type'     => 'product',
    'post_status'    => 'inherit'
    );

    // Create the attachment
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

    // Include image.php
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

    // Assign metadata to attachment
    wp_update_attachment_metadata( $attach_id, $attach_data );

    update_woocommerce_term_meta( $parent_category['term_id'], 'thumbnail_id', $attach_id );

    // create Product START
    foreach ( $trendy_storefront_products_name as $key => $trendy_storefront_product_title ) {

      $content = 'Te obtinuit ut adepto satis somno.';
      // Create post object
      $my_post = array(
        'post_title'    => wp_strip_all_tags( $trendy_storefront_product_title ),
        'post_content'  => $content,
        'post_status'   => 'publish',
        'post_type'     => 'product',
      );

      // Insert the post into the database
      $post_id    = wp_insert_post($my_post);

      wp_set_object_terms( $post_id, 'product_cat' . $k, 'product_cat', true );

      update_post_meta($post_id, '_regular_price', '14.22'); // Set regular price	
      update_post_meta($post_id, '_sale_price', '12'); // Set sale price
      update_post_meta($post_id, '_price', '12'); // Set current price (sale price is applied)

      // Now replace meta w/ new updated value array
      $image_url = get_template_directory_uri().'/assets/images/'.str_replace( " ", "-", $trendy_storefront_product_title).'.png';

      echo $image_url . "<br>";

      $trendy_storefront_image_name       = $trendy_storefront_product_title.'.png';
      $upload_dir = wp_upload_dir();
      // Set upload folder
      $trendy_storefront_image_data = file_get_contents(esc_url($image_url));

      // Get image data
      $unique_file_name = wp_unique_filename($upload_dir['path'], $trendy_storefront_image_name);
      // Generate unique name
      $filename = basename($unique_file_name);
      // Create image file name

      // Check folder permission and define file location
      if (wp_mkdir_p($upload_dir['path'])) {
        $file = $upload_dir['path'].'/'.$filename;
      } else {
        $file = $upload_dir['basedir'].'/'.$filename;
      }

      // Create the image  file on the server
      if ( ! function_exists( 'WP_Filesystem' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
      }
      
      WP_Filesystem();
      global $wp_filesystem;
      
      if ( ! $wp_filesystem->put_contents( $file, $trendy_storefront_image_data, FS_CHMOD_FILE ) ) {
        wp_die( 'Error saving file!' );
      }

      // Check image file type
      $wp_filetype = wp_check_filetype($filename, null);

      // Set attachment data
      $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => sanitize_file_name($filename),
        'post_type'      => 'product',
        'post_status'    => 'inherit',
      );

      // Create the attachment
      $attach_id = wp_insert_attachment($attachment, $file, $post_id);

      // Include image.php
      require_once (ABSPATH.'wp-admin/includes/image.php');

      // Define attachment metadata
      $attach_data = wp_generate_attachment_metadata($attach_id, $file);

      // Assign metadata to attachment
      wp_update_attachment_metadata($attach_id, $attach_data);

      // And finally assign featured image to post
      set_post_thumbnail($post_id, $attach_id);
    }
    // Create product END
    ++$k;
  }
    
?>