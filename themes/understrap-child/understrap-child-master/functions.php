<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

add_theme_support( 'custom-logo' );
function understrap_child_custom_logo_setup() {
 add_image_size('mytheme-logo', 338, 60);
 $defaults = array(
 'height'      => 60,
 'width'       => 338,
 'flex-height' => true,
 'flex-width'  => true,
 'header-text' => array( 'site-title', 'site-description' ),
 );

 add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'understrap_child_custom_logo_setup' );

function wpbeginner_numeric_posts_nav() {
 
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation "><ul>' . "\n";
 
    $prev_url = get_previous_posts_page_link();
    

    $prev_link = '<a aria-label="previous page" href="' . $prev_url . '">&laquo; Previous Page</a>'; 

    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", $prev_link );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
        if(1 == $paged){
            $aria = "current page, page 1";
            $aria_current = 'aria-current="true"';
        } else {
            $aria = "page 1";
            $aria_current = '';
        }
 
        printf( '<li%s><a aria-label="%s" %s href="%s">%s</a></li>' . "\n", $class, $aria, $aria_current, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        if($paged == $link){
            $aria = "current page, page " . $link;
            $aria_current = 'aria-current="true"';
        } else {
            $aria = "page " . $link . " of " . $max;
            $aria_current = '';
        }
        printf( '<li%s><a aria-label="%s" %s href="%s">%s</a></li>' . "\n",  $class, $aria, $aria_current,  esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        if($paged == $max){
            $aria = "current page, page " . $link;
            $aria_current = 'aria-current="true"';
        } else {
            $aria = "page " . $max;
            $aria_current = "";
        }
        printf( '<li%s><a aria-label="%s" %s href="%s">%s</a></li>' . "\n", $class, $aria, $aria_current, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */

    $next_url = get_next_posts_page_link();
    

    $next_link = '<a aria-label="next page" href="' . $next_url . '">Next Page &raquo;</a>'; 


    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", $next_link );
 
    echo '</ul></div>' . "\n";
 
}

function add_link_atts($atts) {
  $atts['title'] = "";
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_link_atts');


// Check for unique guid in badge program
add_filter('acf/validate_value/name=site_guid', 'acf_unique_value_field', 10, 4);
  
  function acf_unique_value_field($valid, $value, $field, $input) {
    if (!$valid || (!isset($_POST['post_ID']) && !isset($_POST['post_id']))) {
      return $valid;
    }
    if (isset($_POST['post_ID'])) {
      $post_id = intval($_POST['post_ID']);
    } else {
      $post_id = intval($_POST['post_id']);
    }
    if (!$post_id) {
      return $valid;
    }
    $post_type = get_post_type($post_id);
    $field_name = $field['name'];
    $args = array(
      'post_type' => $post_type,
      'post_status' => 'publish, draft, trash',
      'post__not_in' => array($post_id),
      'meta_query' => array(
        array(
          'key' => $field_name,
          'value' => $value
        )
      )
    );
    $query = new WP_Query($args);
    if (count($query->posts)){
      return 'That site has already been added.';
    }
    return true;
}

// Check for unique promo code 
add_filter('acf/validate_value/name=promo_code', 'acf_promo_unique_value_field', 10, 4);
  
  function acf_promo_unique_value_field($valid, $value, $field, $input) {
    if (!$valid || (!isset($_POST['post_ID']) && !isset($_POST['post_id']))) {
      return $valid;
    }
    if (isset($_POST['post_ID'])) {
      $post_id = intval($_POST['post_ID']);
    } else {
      $post_id = intval($_POST['post_id']);
    }
    if (!$post_id) {
      return $valid;
    }
    $post_type = get_post_type($post_id);
    $field_name = $field['name'];
    $args = array(
      'post_type' => $post_type,
      'post_status' => 'publish, draft, trash',
      'post__not_in' => array($post_id),
      'meta_query' => array(
        array(
          'key' => $field_name,
          'value' => $value
        )
      )
    );
    $query = new WP_Query($args);
    if (count($query->posts)){
      return 'Promo code already exists.';
    }
    return true;
}


// define the updated_post_meta callback
function my_action_updated_post_meta($post_id) {
   $post_type = get_post_type($post_id); 
   $post_status = get_post_status( $post_id );


    if($post_type == "promo_system") {
         $fields = array_keys($_POST['acf']);
         $key = $fields[0];
         $promo_code = $_POST['acf'][$key];
         $old_promo_code = get_field('promo_code', $post_id);
         $page_exists = 0;
         if($old_promo_code){
            $page_exists = get_page_by_title($old_promo_code);  
         } 

          
        switch ( $post_status ) {
            case 'draft':
                var_dump("draft state");
                die();
            case 'auto-draft':
                 var_dump("auto draft state");
                 die();
            case 'pending':
            case 'inherit':
            case 'trash':
                  wp_delete_post($post_id, true); 
                  wp_delete_post($page_exists->ID, true); // Delete existing page                 
                return;

            case 'future':
            case 'publish':

               

                if($page_exists == 0 && $old_promo_code == null)
                {
                    $post_details = array(
                  'post_title'    => $promo_code,
                  'post_status'   => 'publish',
                  'post_author'   => 1,
                  'post_type' => 'page',
                  'post_parent' => get_id_by_slug('promo'),
                  'page_template' => 'page-promocode.php'
                   );
                   wp_insert_post( $post_details );   
                } 
                else if($page_exists->ID > 0 && $old_promo_code != $promo_code)
                {
                    // Updating

                    wp_delete_post($page_exists->ID, true); // Delete existing page

                  $post_details = array(
                  'post_title'    => $promo_code,
                  'post_status'   => 'publish',
                  'post_author'   => 1,
                  'post_type' => 'page',
                  'post_parent' => get_id_by_slug('promo'),
                  'page_template' => 'page-promocode.php'
                   );
                   wp_insert_post( $post_details ); 
                }


                 
                

            case 'private':
                // continue

        }

    }

};

// add the action
add_action( 'post_updated', 'my_action_updated_post_meta', 10, 3 );

function get_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
} 


// add only single product
add_filter( 'woocommerce_add_to_cart_validation', 'asx_only_one_in_cart', 99, 2 );
   
function asx_only_one_in_cart( $passed, $added_product_id ) {
   wc_empty_cart();
   return $passed;
}



// redirect directly to checkout page after adding to cart
add_filter ('add_to_cart_redirect', 'redirect_to_checkout');

function redirect_to_checkout() {
    global $woocommerce;
    $checkout_url = $woocommerce->cart->get_checkout_url();
    return $checkout_url;
}

// Hook to add placeholder to billing fields in checkout page
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
     $fields['billing']['billing_first_name']['placeholder'] = 'Name';
     $fields['billing']['billing_first_name']['label'] = 'Name';
     $fields['billing']['billing_first_name']['class'] = array('form-row-wide');
     

   //  $fields['billing']['billing_country']['class'] = array('form-row-wide');;     
     $fields['billing']['billing_city']['placeholder'] = 'City';
     $fields['billing']['billing_postcode']['placeholder'] = 'Post Code';
     
     $fields['billing']['billing_email']['placeholder'] = 'Email';
     $fields['billing']['billing_email']['priority'] = 10;
     $fields['billing']['billing_website'] = array(
        'label'     => __('Website to test', 'woocommerce'),
    'placeholder'   => _x('Website to test', 'placeholder', 'woocommerce'),
    'required'  => true,
    'class'     => array('form-row-wide'),
    'clear'     => true,
    'priority'  => 20
     );


     unset($fields['billing']['billing_last_name']);
     unset($fields['billing']['billing_company']);
     unset($fields['billing']['billing_address_1']);
     unset($fields['billing']['billing_address_2']);
     unset($fields['billing']['billing_city']);
     unset($fields['billing']['billing_country']);
     unset($fields['billing']['billing_state']);
     unset($fields['billing']['billing_postcode']);
     unset($fields['billing']['billing_phone']);
     unset($fields['order']['order_comments']);
     
     return $fields;
}

// Remove additional information heading
add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );


// Hook in
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );



/**
 * Display field value on the order edit page
 */
 
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Website').':</strong> <a href=' . get_post_meta( $order->get_id(), '_billing_website', true ) . '>' . get_post_meta( $order->get_id(), '_billing_website', true ) . '</a></p>';
}


// remove message that say added to cart
add_filter( 'wc_add_to_cart_message_html', '__return_null' );

/*
if ( ! function_exists( 'understrap_wc_form_field_args' ) ) {
  // This function replaces the Understrap function of the same name
  function understrap_wc_form_field_args( $args, $key, $value = null ) {
    return $args;
  }
}
*/

/* Redirect to checkout after adding to cart */
add_filter( 'woocommerce_add_to_cart_redirect', 'understrap_redirect_checkout_add_cart' );
 
function understrap_redirect_checkout_add_cart() {
   return wc_get_checkout_url();
}

