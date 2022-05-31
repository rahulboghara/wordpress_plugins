<?php
/*
Plugin Name : ZS Mega Menu
Plugin URL: https://www.zitronesolutions.com
Description : The plugin developed offers the functionality to add the mega menu as a horizontal or vertical menu , these plugin offers mega menu creation using WPBakery Page Builder according to the custom structure required , the mega menu developed with these plugin can be used no of times within the website.
Version : 1.0 
Author : Zitrone Solutions
Author URI : https://www.zitronesolutions.com
License : GPLv2
*/


if ( ! defined( 'ABSPATH' ) ) die( 'Accessing this file directly is denied.' );

if (!class_exists('zs_mega_menu')){
    class zs_mega_menu{

        public function __construct()
        {
            //At first, we need to define the required CONSTANT for the plugin
            $this->_define_constant();
            // now lets include all the required files
            $this->_include();

            new ZS_Utility();

            add_action('admin_enqueue_scripts', array($this, 'backend_enqueue_scripts_and_styles'));
            add_filter('wp_nav_menu_args', array($this, 'zs_mega_menu_args'), 10000);
            add_action('admin_menu', array($this, 'hook_usage_submenu'));
        }

        private function _define_constant()
        {
            /**
             * Defining constants
             */
            if( ! defined( 'ZS_PLUGIN_DIR' ) ) define( 'ZS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
            if( ! defined( 'ZS_PLUGIN_URI' ) ) define( 'ZS_PLUGIN_URI', plugins_url( '', __FILE__ ) );
            if( ! defined( 'ZS_TEXTDOMAIN' ) ) define( 'ZS_TEXTDOMAIN', 'zs-mega-menu' );
        }

        private function _include()
        {
            require_once ZS_PLUGIN_DIR . 'includes/zs-utility.php';
            require_once ZS_PLUGIN_DIR . 'includes/classes/class-wp-bootstrap-navwalker.php';
        }

        /**
         * Use the ZS Mega Menu walker to output the menu
         */
        public function zs_mega_menu_args($args) {
            $current_theme_location = $args['theme_location']; // get current menu location i.e primary
            $locations = get_nav_menu_locations(); // get all menu location
            $menu_id = $locations[$current_theme_location]; // set menu_id

            // set all menu location to wp bootstrap navwalker  
            $defaults = array(
                'menu' => $menu_id,
                'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
                'walker' => new wp_bootstrap_navwalker()
            );
            $args = array_merge($args, apply_filters("zs_mega_menu_args", $defaults, $menu_id, $current_theme_location));

            return $args;
        }

        /**
         *  ZS Mega Menu how to use section
         */

        function hook_usage_submenu() {
            add_submenu_page( 'edit.php?post_type=zs_mega_menu', __('How To Use', ZS_TEXTDOMAIN), __('How To Use', ZS_TEXTDOMAIN), 'manage_options', 'zs_usage', array($this, 'zs_display_usage') );
        }
        
        public function zs_display_usage()
        {
            include ZS_PLUGIN_DIR .'includes/zs-how-to-use.php';
        }

    }
}
new zs_mega_menu();






