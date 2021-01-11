<?php
/**
 * Plugin Name: LibanPost Shipping Woocommerce
 * Description: This is a plugin for the API integration between WooCommerce and LibanPost
 * Version: 1.0
 * Author: Samah Basheer | Ali Basheer
 **/

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

class WC_Settings_Tab_API
{

    public static function init()
    {
        add_filter('woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50);
        add_action('woocommerce_settings_tabs_settings_tab_api', __CLASS__ . '::settings_tab');
        add_action('woocommerce_update_options_settings_tab_api', __CLASS__ . '::update_settings');
    }


    public static function add_settings_tab($settings_tabs)
    {
        $settings_tabs['settings_tab_api'] = __('LibanPost API', 'woocommerce-settings-tab-api');
        return $settings_tabs;
    }


    public static function settings_tab()
    {
        woocommerce_admin_fields(self::get_settings());
    }


    public static function update_settings()
    {
        woocommerce_update_options(self::get_settings());
    }

    public static function get_settings()
    {

        $settings = array(
            'section_title' => array(
                'name' => __('API integration', 'woocommerce-settings-tab-api'),
                'type' => 'title',
                'desc' => '',
                'id' => 'wc_settings_tab_api_section_title'
            ),
            'title' => array(
                'name' => __('Title', 'woocommerce-settings-tab-api'),
                'type' => 'text',
                'desc' => __('Title of your store', 'woocommerce-settings-tab-api'),
                'id' => 'wc_settings_tab_api_title'
            ),
            'email' => array(
                'name' => __('Email', 'woocommerce-settings-tab-api'),
                'type' => 'email',
                'desc' => __('Email address for your site.', 'woocommerce-settings-tab-api'),
                'id' => 'wc_settings_tab_email'
            ),
            'api' => array(
                'name' => __('API key', 'woocommerce-settings-tab-api'),
                'type' => 'text',
                'desc' => __('The API key for connecting with your LibanPost account.', 'woocommerce-settings-tab-api'),
                'id' => 'wc_settings_tab_api'
            ),
            'erpcode' => array(
                'name' => __('ERPCode', 'woocommerce-settings-tab-api'),
                'type' => 'text',
                'desc' => __('The ERPCode for connecting with your LibanPost account.', 'woocommerce-settings-tab-api'),
                'id' => 'wc_settings_tab_erpcode'
            ),
            'section_end' => array(
                'type' => 'sectionend',
                'id' => 'wc_settings_tab_api_section_end'
            )
        );

        return apply_filters('wc_settings_tab_api_settings', $settings);
    }

}

WC_Settings_Tab_API::init();

//enqueue js and css files

function enqueuing_admin_scripts(){
    if(!(get_post_type() == 'shop_order')) {
        return;
    }
    wp_enqueue_style('admin-your-css-file-handle-name', plugin_dir_url( __FILE__ ).'/assets/css/libanpost.css');
    wp_enqueue_script('admin-your-js-file-handle-name', plugin_dir_url( __FILE__ ).'/assets/js/libanpost.js');
}

add_action( 'admin_enqueue_scripts', 'enqueuing_admin_scripts' );

//adding prepare LibanPost shipment button

function action_woocommerce_admin_order_data_after_order_details( $wccm_before_checkout ) {
    echo '
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
    ';
};
add_action( 'woocommerce_admin_order_data_after_order_details', 'action_woocommerce_admin_order_data_after_order_details', 10, 1 );