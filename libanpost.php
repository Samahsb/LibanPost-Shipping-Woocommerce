<?php
/**
 * Plugin Name: LibanPost Shipping Woocommerce
 * Description: This is a plugin for the API integration between WooCommerce and LibanPost
 * Version: 1.0
 * Author: Samah Basheer | Ali Basheer
 **/

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once dirname( __FILE__ ) . '/includes/setting-class.php';
include_once dirname( __FILE__ ) . '/includes/prepare-shipment.php';

/**
 * Adds plugin page configure link
 */
function libanpost_shipping_plugin_links( $links ) {
	$plugin_links = array(
		'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=settings_tab_api' ) . '">Configure</a>'
	);
	return array_merge( $plugin_links, $links );
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'libanpost_shipping_plugin_links' );

/**
 * enqueue js and css files
 */
function libanpost_enqueuing_admin_scripts() {
    if( ! ( get_post_type() == 'shop_order' ) ) {
        return;
    }

    wp_enqueue_style( 'admin-your-css-file-handle-name', plugin_dir_url( __FILE__ ) . '/assets/css/libanpost.css' );
    wp_enqueue_script( 'admin-your-js-file-handle-name', plugin_dir_url( __FILE__ ) . '/assets/js/libanpost.js' );
}
add_action( 'admin_enqueue_scripts', 'libanpost_enqueuing_admin_scripts' );