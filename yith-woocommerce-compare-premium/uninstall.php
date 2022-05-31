<?php
/**
 * Uninstall plugin
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Compare
 * @version 1.0.0
 */

// If uninstall not called from WordPress exit
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

//delete pages created for this plugin
wp_delete_post( get_option( 'yith-wrvp-page-id' ), true );
delete_option( 'yith-wrvp-page-id' );