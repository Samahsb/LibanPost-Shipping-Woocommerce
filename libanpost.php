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


/**
 * adding prepare LibanPost shipment button
 */
function libanpost_woocommerce_admin_order_data_after_order_details( $wccm_before_checkout ) {
	?>
	<div class="prepare-shipment-btn" onclick="ShowShipmentDetails()"> Prepare LibanPost Shipment </div>
	<div class="libanpost-overlay" id="libanpost_overlay">
		<div class="libanpost-shipment-creation">
			<span class="dashicons dashicons-no-alt" onclick="HideShipmentDetails()"></span>
			<fieldset>
				<legend>Billing Account</legend>
				<input type="text">
			</fieldset>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_admin_order_data_after_order_details', 'libanpost_woocommerce_admin_order_data_after_order_details', 10, 1 );