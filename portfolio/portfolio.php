<?php
/*
Plugin Name: Portfolio
Plugin URI: https://www.zitronesolutions.com/
Description: This plugin create a custom post type displaying portfolio.
Version: 1.0
Author: Zitrone Solutions
Author URI: https://www.zitronesolutions.com/
License: GPLv2
*/

/**
 * Custom portfolio post
 */

function portfolio_post_type (){
	
	$labels = array(
		'name' => 'Portfolio',
		'singular_name' => 'Portfolio',
		'add_new' => 'Add New',
		'all_items' => 'All Item',
		'add_new_item' => 'Add Item',
		'edit_item' => 'Edit Item',
		'new_item' => 'New Item',
		'view_item' => 'View Items',
		'search_item' => 'Search Items PortFolio',
		'not_found' => 'No Items found',
		'not_found_in_trash' => 'No Item found in trash',
		'parent_item_colon' => 'Parent Item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_icon' => 'dashicons-video-alt',
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
			'author',
			'comments', 
			'revisions', 
			'custom-fields',
			'discussion',
		),
		'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 15,
		'exclude_from_search' => false
	);
	register_post_type('Portfolio',$args);
}
add_action('init','portfolio_post_type');


