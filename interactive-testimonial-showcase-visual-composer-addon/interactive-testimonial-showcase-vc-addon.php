<?php
/**
 * Plugin Name: Interactive Testimonial Showcase Visual Composer Addon
 * Plugin URI: https://www.zitronesolutions.com/
 * Description: Visual composer addon for Interactive & Engaging Testimonial Showcase.
 * Version: 1.2
 * Author: Zitrone Solutions
 * Text Domain: hs-testimonial-visual-composer-addon
 * Author URI: https://www.zitronesolutions.com/
 */
 
 
/* * *****************************************************
 * Function to check the VC activated & VC version
 * ***************************************************** */
add_action('admin_init', 'hs_testimonial_check_version');

function hs_testimonial_check_version() {
    $required_vc = '4.3';
    if (defined('WPB_VC_VERSION')) {
        if (version_compare($required_vc, WPB_VC_VERSION, '>')) {
            add_action('admin_notices', 'hs_testimonial_version_vc');
        }
    } else {
        add_action('admin_notices', 'hs_testimonial_on_activate');
    }
}

/* Visual composer plugin version */

function hs_testimonial_version_vc() {
    echo '<div class="error"><p>' . __('HS Testimonial Visual Composer plugin requires Visual Composer version 4.3 or greater.', 'hs-testimonial-visual-composer-addon') . '</p></div>';
}

/* Visual composer plugin activated or not */

function hs_testimonial_on_activate() {
    echo '<div class="error"><p>' . __('HS Testimonial Visual Composer plugin requires Visual Composer installed and activated.', 'hs-testimonial-visual-composer-addon') . '</p></div>';
}

add_image_size('hs-testimonial-custom', '120', '120', true);
/*
 * Function Create Custom Post - showcase_carousel
 */
add_action('init', 'hs_testimonial_vc_addon_cpt');

function hs_testimonial_vc_addon_cpt() {
    register_post_type('hs_testimonials', array(
        'labels' => array(
            'name' => __('HS Testimonials', 'hs-testimonial-visual-composer-addon'),
            'singular_name' => __('HS Testimonial', 'hs-testimonial-visual-composer-addon'),
            'menu_name' => __('HS Testimonials', 'hs-testimonial-visual-composer-addon'),
            'parent_item_colon' => __('Parent Testimonial:', 'hs-testimonial-visual-composer-addon'),
            'all_items' => __('All Testimonials', 'hs-testimonial-visual-composer-addon'),
            'view_item' => __('View Testimonial', 'hs-testimonial-visual-composer-addon'),
            'add_new_item' => __('Add New Testimonial', 'hs-testimonial-visual-composer-addon'),
            'add_new' => __('Add New', 'hs-testimonial-visual-composer-addon'),
            'edit_item' => __('Edit Testimonial', 'hs-testimonial-visual-composer-addon'),
            'update_item' => __('Update Testimonial', 'hs-testimonial-visual-composer-addon'),
            'search_items' => __('Search Testimonial', 'hs-testimonial-visual-composer-addon'),
            'not_found' => __('Not found', 'hs-testimonial-visual-composer-addon'),
            'not_found_in_trash' => __('Not found in Trash', 'hs-testimonial-visual-composer-addon')
        ),
        'public' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail'),
        'taxonomies' => array(''),
        'register_meta_box_cb' => 'hs_testimonials_meta_box',
        'has_archive' => true
        )
    );
}

//enqueue script in backend
function hs_testimonail_addon_script() {
    wp_enqueue_script('hs-testimonial-admin-js', plugins_url('/admin/js/hs_function.js', __FILE__), false, '1', false);

    //variable to use in the js file
    $jsvariables = array(
        'template_path' => plugins_url('admin/images/', __FILE__)
    );
    wp_localize_script('hs-testimonial-admin-js', 'js_custom_object', $jsvariables);
}

add_action('admin_enqueue_scripts', 'hs_testimonail_addon_script');

//enqueue script in backend
function hs_testimonail_addon_script_frontend() {
    wp_enqueue_script( 'hs-jquery.matchHeight-min', plugins_url('/templates/js/jquery.matchHeight-min.js', __FILE__), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'hs-testimonial-custom-js', plugins_url('/templates/js/hs-testimonial-custom.js', __FILE__), array( 'jquery' ), '1.0', true );
}

add_action('wp_enqueue_scripts', 'hs_testimonail_addon_script_frontend');


require_once('templates/template.php');
require_once('includes/shortcode-testimonial.php');
require_once('includes/testimonial_meta_box.php');
require_once('includes/vc-testimonials.php');
