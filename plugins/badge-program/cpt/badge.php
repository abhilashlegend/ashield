<?php

function cptui_register_my_cpts_badge() {

	/**
	 * Post Type: Badge Programs.
	 */

	$labels = array(
		"name" => __( "Badge Programs", "understrap-child" ),
		"singular_name" => __( "Badge Program", "understrap-child" ),
		"menu_name" => __( "Badge Programs", "understrap-child" ),
		"all_items" => __( "All Badge Programs", "understrap-child" ),
		"add_new" => __( "New Badge Program", "understrap-child" ),
		"add_new_item" => __( "Add New Badge Program", "understrap-child" ),
		"edit_item" => __( "Edit Badge Program", "understrap-child" ),
		"new_item" => __( "New Badge Program", "understrap-child" ),
		"view_item" => __( "View Badge Program", "understrap-child" ),
		"view_items" => __( "View Badge Programs", "understrap-child" ),
		"search_items" => __( "Search Badge Program", "understrap-child" ),
		"not_found" => __( "No Badge Programs found", "understrap-child" ),
		"not_found_in_trash" => __( "No Badge Programs found in Trash", "understrap-child" ),
	);

	$args = array(
		"label" => __( "Badge Programs", "understrap-child" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "badge", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "custom-fields" ),
	);

	register_post_type( "badge", $args );
}

add_action( 'init', 'cptui_register_my_cpts_badge' );

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5dcd7e6a8bd60',
	'title' => 'Badge Program',
	'fields' => array(
		array(
			'key' => 'field_5fe04d58b9237',
			'label' => 'friendly name',
			'name' => 'friendly_name',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5dcd7ea190148',
			'label' => 'client name',
			'name' => 'client_name',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5dcd7ecd90149',
			'label' => 'website name',
			'name' => 'website_name',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5dcd7eed9014a',
			'label' => 'email',
			'name' => 'email',
			'type' => 'email',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_5dcd7f2c9014b',
			'label' => 'phone',
			'name' => 'phone',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5dcd7f4d9014c',
			'label' => 'post date',
			'name' => 'post_date',
			'type' => 'date_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'd/m/Y',
			'return_format' => 'd/m/Y',
			'first_day' => 1,
		),
		array(
			'key' => 'field_5dced24fc945b',
			'label' => 'active',
			'name' => 'active',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 1,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_5fbde5d11978b',
			'label' => 'status',
			'name' => 'status',
			'type' => 'select',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'valid' => 'Valid',
				'expired' => 'Expired',
			),
			'default_value' => array(
				0 => 'valid',
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'return_format' => 'value',
			'ajax' => 0,
			'placeholder' => '',
		),
		array(
			'key' => 'field_5fbde73d1978c',
			'label' => 'category',
			'name' => 'category',
			'type' => 'select',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'certified' => 'Certified',
				'certified with badge' => 'Certified with badge',
				'certification in progress' => 'Certification in progress'
			),
			'default_value' => array(
				0 => 'certification in progress',
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'return_format' => 'value',
			'ajax' => 0,
			'placeholder' => '',
		),
		array(
			'key' => 'field_5fbde9281978d',
			'label' => 'valid to',
			'name' => 'valid_to',
			'type' => 'date_picker',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'd/m/Y',
			'return_format' => 'm/d/Y',
			'first_day' => 1,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'badge',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;

?>