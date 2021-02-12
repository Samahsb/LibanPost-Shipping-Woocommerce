<?php

class WC_Settings_Tab_LibanPost_API {

	public static function init() {
		add_filter('woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50);
		add_action('woocommerce_settings_tabs_settings_tab_api', __CLASS__ . '::settings_tab');
		add_action('woocommerce_update_options_settings_tab_api', __CLASS__ . '::update_settings');
	}

	public static function add_settings_tab($settings_tabs) {
		$settings_tabs['settings_tab_api'] = __('LibanPost API', 'woocommerce-settings-tab-api');
		return $settings_tabs;
	}


	public static function settings_tab() {
		woocommerce_admin_fields(self::get_settings());
	}


	public static function update_settings() {
		woocommerce_update_options(self::get_settings());
	}

	public static function get_settings() {

		$settings = array(
			'section_title' => array(
				'name' => __('API integration', 'woocommerce-settings-tab-api'),
				'type' => 'title',
				'desc' => '',
				'id' => 'wc_settings_tab_api_section_title'
			),
			'name' => array(
				'name' => __('Name', 'woocommerce-settings-tab-api'),
				'type' => 'text',
				'desc' => __('Name of your store', 'woocommerce-settings-tab-api'),
				'id' => 'wc_settings_tab_api_name'
			),
			'address' => array(
				'name' => __('Address', 'woocommerce-settings-tab-api'),
				'type' => 'text',
				'desc' => __('Address of your store', 'woocommerce-settings-tab-api'),
				'id' => 'wc_settings_tab_api_address'
			),
            'phoneNb' => array(
                'name' => __('Phone Number', 'woocommerce-settings-tab-api'),
                'type' => 'number',
                'desc' => __('Store Phone Number.', 'woocommerce-settings-tab-api'),
                'id' => 'wc_settings_tab_api_phone_nb'
            ),
			'token' => array(
				'name' => __('Token', 'woocommerce-settings-tab-api'),
				'type' => 'text',
				'desc' => __('Given token for connecting with your LibanPost account.', 'woocommerce-settings-tab-api'),
				'id' => 'wc_settings_tab_token'
			),
			'erpcode' => array(
				'name' => __('ERP Code', 'woocommerce-settings-tab-api'),
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

WC_Settings_Tab_LibanPost_API::init();
