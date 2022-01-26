<?php
/**
 * @package Badge Program
 */
/*
Plugin Name: Badge Program
Description:  
Version: 0.0.1
Author: Abhilash
License: GPLv2 or later
Text Domain: badge
*/

/* !0. TABLE OF CONTENTS */

/* 
	1. Hooks
		1.1 - Register our Plugin Menu
		1.2 - registers all our custom shortcodes on init
		1.3 - load external files to public website

	2. ShortCodes
		2.0 - register shortcode
		2.1 - bmg forms shortcode 
	

	3. Filters
		3.1 - admin menus

    4. External Scripts
    	4.1 - loads external files into PUBLIC website 
    	4.2 - loads external files into admin

    5. Actions
    	5.1 - create all tables related to plugin
    	5.2 - remove all tables on uninstall

    6. Helpers
    	6.1 - validate whether plugin is usable to this site

    7. Custom Post types

    8. Admin Pages
    	 8.1 - forms page
    	 8.2 - Submissions page
    	 	8.2.1 - Submission detail page
    	 8.3 - new form

    9. Settings

*/
    
/* 1. Hooks */

// 1.1
// hint: register custom title field
add_filter( 'enter_title_here', 'badge_program_enter_title_field' );

// 1.2
// hint: register custom admin column headers
add_filter('manage_edit-badge_columns','badge_program_column_headers');
add_filter('manage_badge_posts_custom_column','badge_program_column_data',1,2);

// 1.3 
// hint: register our custom menus
// add_action('admin_menu', 'tms_admin_menus');

// 1.4
// hint: register template
add_filter( 'single_template', 'get_badge_program_template' ) ;

// 1.5
//hint: load external files in wordpress admin
//add_action('admin_enqueue_scripts', 'tms_admin_scripts');

// 1.6
//hint: load public scripts
//add_action('wp_enqueue_scripts', 'tms_public_scripts',99);

//add_filter('wp_title', 'badge_program_custom_title', 9999999, 3);
  



/* 3. Filters */

// 3.1

function badge_program_column_headers( $columns ) {
  
  // creating custom column header data
  $columns = array(
    'cb'=>'<input type="checkbox" />',
    'friendly_name'=>__('Friendly Name'),
    'title'=>__('GUID'),
    'url'=>__('URL'),
    'is_active'=>__('isActive'),
    'date'=>__('Date'), 
  );
  
  // returning new columns
  return $columns;
  
}

//3.2

function badge_program_column_data( $column, $post_id ) {

 $wpg_row_actions  = wpg_row_actions();
  
  // setup our return text
  $output = '';
  
  switch( $column ) {
    case 'friendly_name':
      $friendly_name = "<b>" . get_field('friendly_name', $post_id ) . "</b>" . $wpg_row_actions;
      $output .= $friendly_name;
      break;
    case 'guid':
      $guid = get_the_title($post_id);
      $output .= $guid;
      break;
    case 'url':
      $website_name = get_field('website_name', $post_id);;
      $output .= $website_name;  
      break;
    case 'is_active':
      $isActive = get_field('status', $post_id);
      $output .= $isActive ? 'true' : 'false';
      break;  
    case 'date':
    $date = get_field('date', $post_id );
    $output .= $date;
    break;
  }
  
  // echo the output
  echo $output;
  
}

// 3.3
// hint: registers custom plugin admin menus
/*function tms_admin_menus() {
  
  
    $top_menu_item = 'edit.php?post_type=testmysite';
   

}
*/

// 3.4
// hint: change enter title placeholder / label
function badge_program_enter_title_field( $input ) {
    if ( 'badge' === get_post_type() ) {
        return __( 'Enter GUID', 'understrap' );
    }

    return $input;
}

// 3.5
// hint: add custom template for testmysite
function get_badge_program_template($single_template) {
    global $wp_query, $post;
    if ($post->post_type == 'badge'){
        $single_template = plugin_dir_path(__FILE__) . '/templates/frontend/badge_template.php';
    }
    return $single_template;
}

add_filter('acf/load_field/name=valid_to', function ($field) {
    $field['default_value'] = date('Ymd', strtotime('+1 year'));
    return $field;
});






/* 4. External Scripts */

//4.1
// Include ACF
include_once( plugin_dir_path( __FILE__ ) .'lib/advanced-custom-fields-pro/acf.php' );


// 4.2
// hint: loads external files into admin
  /*function tms_admin_scripts() {
       
    wp_register_script('test-my-site-admin', plugins_url('assets/private/js/test-my-site-admin.js', __FILE__), array(), false, true);

    wp_enqueue_script('test-my-site-admin');
  }
*/

  // 4.1
  // hint: loads external files into PUBLIC website 
  /*function tms_public_scripts() { 
   

    wp_register_style('testmysite-css-public', plugins_url('assets/public/css/test-my-site-public.css', __FILE__));

    wp_register_script('testmysite-circle-progressbar-public', plugins_url('assets/public/js/circles.min.js', __FILE__), array('jquery'), null, false);

     wp_register_script('testmysite-public', plugins_url('assets/public/js/testmysite-public.js', __FILE__), array('testmysite-circle-progressbar-public'), null, false);

    wp_enqueue_style('testmysite-css-public');

    wp_enqueue_script('testmysite-circle-progressbar-public');

    wp_enqueue_script('testmysite-public');

  }
*/


/* Actions */





/* 6. Helpers */

/*
function wpg_row_actions() {
  global $post;
  if($post->post_type == 'page') {
    if(!current_user_can('edit_page')) {
      return;
    }
  }
  else {
    if(!current_user_can('edit_post')) {
      return;
    }
  }
  if($post->post_status == 'trash') {
    $actionLinks  = '<div class="row-actions"><span class="untrash"><a title="'.__('Restore this item', 'quotable').'" href="'.wp_nonce_url(get_admin_url().'post.php?post='.$post->ID.'&amp;action=untrash', 'untrash-'.$post->post_type.'_'.$post->ID).'">'.__('Restore', 'quotable').'</a> | </span>';
    $actionLinks .= '<span class="trash"><a href="'.wp_nonce_url(get_admin_url().'post.php?post='.$post->ID.'&amp;action=delete', 'delete-'.$post->post_type.'_'.$post->ID).'" title="'.__('Delete this item permanently', 'quotable').'" class="submitdelete">'.__('Delete Permanently', 'quotable').'</a></span>';
  }
  else {
    $actionLinks  = '<div class="row-actions"><span class="edit"><a title="'.__('Edit this item', 'quotable').'" href="'.get_admin_url().'post.php?post='.$post->ID.'&amp;action=edit">'.__('Edit', 'quotable').'</a> | </span>';
    $actionLinks .= '<span class="inline hide-if-no-js"><a title="'.__('Edit this item inline', 'quotable').'" class="editinline" href="#">'.__('Quick Edit', 'quotable').'</a> | </span>';
    $trash_link = get_delete_post_link( $post->ID );

    $actionLinks .= '<span class="trash"><a href="'. $trash_link . '" title="'.__('Move this item to the Trash', 'quotable').'" class="submitdelete">'._x('Trash', 'verb (ie. trash this post)', 'quotable').'</a></span>';
  }
  return $actionLinks;
}
*/

/* 7. CUSTOM POST TYPES */

// 7.1 testmysite
include_once( plugin_dir_path( __FILE__ ) . 'cpt/badge.php');


?>