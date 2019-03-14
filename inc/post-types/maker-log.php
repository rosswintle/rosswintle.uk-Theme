<?php

function cptui_register_my_cpts_maker_log() {

	/**
	 * Post Type: Maker Logs.
	 */

	$labels = array(
		"name" => __( "Maker Logs", "oiko_s" ),
		"singular_name" => __( "Maker Log", "oiko_s" ),
		"menu_name" => __( "Maker Log", "oiko_s" ),
		"all_items" => __( "All Logs", "oiko_s" ),
		"add_new" => __( "Add New", "oiko_s" ),
		"add_new_item" => __( "Add New Log", "oiko_s" ),
		"edit_item" => __( "Edit Log", "oiko_s" ),
		"new_item" => __( "New Log", "oiko_s" ),
		"view_item" => __( "View Log", "oiko_s" ),
		"view_items" => __( "View Logs", "oiko_s" ),
		"search_items" => __( "Search Maker Logs", "oiko_s" ),
		"not_found" => __( "No maker logs found", "oiko_s" ),
		"not_found_in_trash" => __( "No maker logs found in trash", "oiko_s" ),
		"parent_item_colon" => __( "Parent log", "oiko_s" ),
		"archives" => __( "Maker Log Archives", "oiko_s" ),
		"insert_into_item" => __( "Insert into log", "oiko_s" ),
		"uploaded_to_this_item" => __( "Uploaded to this log", "oiko_s" ),
		"filter_items_list" => __( "Filter maker logs list", "oiko_s" ),
		"items_list_navigation" => __( "Maker logs list navigation", "oiko_s" ),
		"items_list" => __( "Maker Logs List", "oiko_s" ),
		"attributes" => __( "Maker Log Attributes", "oiko_s" ),
		"name_admin_bar" => __( "Maker Log", "oiko_s" ),
		"parent_item_colon" => __( "Parent log", "oiko_s" ),
	);

	$args = array(
		"label" => __( "Maker Logs", "oiko_s" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => "maker-log",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "maker-log", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-hammer",
		"supports" => array( "title", "editor", "revisions", "author" ),
	);

	register_post_type( "maker_log", $args );
}

add_action( 'init', 'cptui_register_my_cpts_maker_log' );
