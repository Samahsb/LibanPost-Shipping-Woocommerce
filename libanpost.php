<?php
/**
 * Plugin Name: LibanPost Shipping Woocommerce
 * Description: This is a plugin for the API integration between WooCommerce and LibanPost
 * Version: 1.1
 * Author: Samah Basheer | Ali Basheer
 **/

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Check if WooCommerce plugin is activated
 */
if ( ! is_plugin_active('woocommerce/woocommerce.php') ) {
    deactivate_plugins('libanpost-shipping-woocommerce/libanpost.php');
}

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

include_once dirname( __FILE__ ) . '/includes/setting-class.php';
include_once dirname( __FILE__ ) . '/includes/prepare-shipment.php';
include_once dirname( __FILE__ ) . '/includes/libanpost-send-order.php';
include_once dirname( __FILE__ ) . '/includes/libanpost-bulk-projects.php';
include_once dirname( __FILE__ ) . '/includes/class-list-table-project-orders.php';
include_once dirname( __FILE__ ) . '/includes/class-list-table-project-list.php';

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

    if( ! ( get_post_type() == 'shop_order' ) && ! admin_url("admin.php?page=submit-libanpost-project") ) {
        return;
    }

    wp_enqueue_style( 'admin-your-css-file-handle-name', plugin_dir_url( __FILE__ ) . '/assets/css/libanpost.css', array(), '1.0.2' );
    wp_enqueue_script( 'admin-your-js-file-handle-name', plugin_dir_url( __FILE__ ) . '/assets/js/libanpost.js', array(), '1.0.6' );
}
add_action( 'admin_enqueue_scripts', 'libanpost_enqueuing_admin_scripts' );

function libanpost_wpo_wcpdf_before_order_data( $type, $order ){

    $libanpost_number = wc_get_order_item_meta( $order->get_id(), 'libanpost_shipping_nb', true );
    $libanpost_sent = wc_get_order_item_meta( $order->get_id(), 'libanpost_project_id', true );
    ?>

    <?php if ( ! empty( $libanpost_number ) ) { ?>
        <tr class="order-libanpost-number">
            <th>LibanPost Order Nb:</th>
            <td><?php echo $libanpost_number; ?></td>
        </tr>
    <?php } ?>

    <?php if ( ! empty( $libanpost_sent ) ) { ?>
        <tr class="order-libanpost-project">
            <th>LibanPost Project ID:</th>
            <td><?php echo $libanpost_sent; ?></td>
        </tr>
    <?php } ?>

    <?php
}
add_action( 'wpo_wcpdf_before_order_data', 'libanpost_wpo_wcpdf_before_order_data', 10, 2 );


function libanpost_wpo_wcpdf_after_shop_address( $type, $order ){

        require_once 'vendor/autoload.php';
        $libanpost_number = wc_get_order_item_meta( $order->get_id(), 'libanpost_shipping_nb', true );
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        ?>

        <style>
            .barcode-image > div {
                margin: 0 auto;
            }
        </style>
        <div class="barcode-image" style="margin-top:40px; text-align: center;">
            <?php
            if($libanpost_number != '') {
                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($libanpost_number, $generator::TYPE_CODE_128)) . '">';
            }
            ?>
        </div>
        <div class="barcode-number" style="margin-top:3px; text-align: center;">
            <?php echo $libanpost_number; ?>
        </div>
        <?php
}
add_action( 'wpo_wcpdf_after_shop_address', 'libanpost_wpo_wcpdf_after_shop_address', 10, 2 );

function me_search_query( $query ) {

	if ( $query->is_search && ! empty( $_GET['admin_filter_libanpost_nb'] ) ) {

		global $wpdb;
		$libanpost_id = $_GET['admin_filter_libanpost_nb'];

		$sql = $wpdb->prepare( "SELECT order_item_id FROM {$wpdb->prefix}woocommerce_order_itemmeta WHERE meta_key = 'libanpost_shipping_nb' AND meta_value = '%s'", $libanpost_id );
		$orders = $wpdb->get_results( $sql );

		$orders_ids = array();

		foreach ( $orders as $order ) {
			$orders_ids[] = (int)$order->order_item_id;
        }

		$query->set('post__in', $orders_ids);
	};
}
add_filter( 'pre_get_posts', 'me_search_query');

function libanpost_filter_restrict_manage_posts(){

	global $wpdb, $table_prefix;

	$post_type = (isset($_GET['post_type'])) ? $_GET['post_type'] : 'post';

	if ( $post_type == 'shop_order' ) {
	    ?>
        <input type="text" id="admin-filter-libanpost-nb" name="admin_filter_libanpost_nb" value="<?php echo isset($_GET['admin_filter_libanpost_nb'])? $_GET['admin_filter_libanpost_nb'] : ''?>" placeholder="Libanpost Number">
		<?php
	}
}
add_action( 'restrict_manage_posts', 'libanpost_filter_restrict_manage_posts');