<?php
/**
 * Plugin Name: LibanPost Shipping Woocommerce
 * Description: This is the first plugin for the API integration between WooCommerce and LibanPost
 * Version: 1.0
 * Author: Samah Basheer | Ali Basheer
 **/

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