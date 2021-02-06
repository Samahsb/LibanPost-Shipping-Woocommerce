<?php

function libanpost_send_order() {
    $libanpost_token =  get_option("wc_settings_tab_token");
    $libanpost_erpcode = get_option("wc_settings_tab_erpcode");
	$request_data = $_POST['orderData'];
	$request_url = "https://hemi.Libanpost.com/api/PKOrder?token=" . $libanpost_token . "&ERPCode=" . $libanpost_erpcode;

	// Request the session
	$response_json = wp_remote_post( $request_url, array(
		'body'	  => json_encode ( $request_data ),
		'headers' => array(
			'content-type' => 'application/json'
		),
	) );

	if ( is_wp_error( $response_json ) ) {
		wp_send_json('WordPress failed to connect with libanpost server');
	}

	$response = json_decode( $response_json['body'], true );

	if( $response['ErrorCode'] == 0 ) {
		wc_add_order_item_meta( $_POST['orderData']['PK_Order']['REFERENCE_ID'], 'libanpost_shipping_nb', $response['OrderNbr'] ) ;
        $order = new WC_Order($_POST['orderData']['PK_Order']['REFERENCE_ID']);
        $order->update_status( 'completed' );
	}

	wp_send_json($response);
}
add_action( 'wp_ajax_libanpost_send_order', 'libanpost_send_order' );

function libanpost_send_project() {

    $libanpost_token =  get_option("wc_settings_tab_token");
    $libanpost_erpcode = get_option("wc_settings_tab_erpcode");
    $request_data = $_POST['orderData'];
    $data_items = $_POST['dataItems'];
    $request_url = "https://hemi.Libanpost.com/api/PKOrder?Mode=N&token=" . $libanpost_token . "&ERPCode=" . $libanpost_erpcode;

    // Request the session
    $response_json = wp_remote_post( $request_url, array(
        'body'	  => json_encode ( $request_data ),
        'headers' => array(
            'content-type' => 'application/json'
        ),
    ) );

    if ( is_wp_error( $response_json ) ) {
        wp_send_json('WordPress failed to connect with libanpost server');
    }

    $response = json_decode( $response_json['body'], true );
    if( $response['ErrorCode'] == 0 ) {

    	foreach ( $data_items as $item ) {
		    wc_add_order_item_meta( $item['id'], 'libanpost_send_project', $response['OrderNbr'] );
	    }
    }

    wp_send_json($response);
}
add_action( 'wp_ajax_libanpost_send_project', 'libanpost_send_project' );

function libanpost_remove_order() {

    $request_url = admin_url().'admin.php?page=submit-libanpost-project';
    $request_data = $_POST['orderData'];
    // Request the session
    $response_json = wp_remote_post( $request_url, array(
        'body'	  => json_encode (),
        'headers' => array(
            'content-type' => 'application/json'
        ),
    ) );
//
//    if ( is_wp_error( $response_json ) ) {
//        wp_send_json('WordPress failed to connect with libanpost server');
//    }

    $response = json_decode( $response_json['body'], true );
    if( $response == 0 ) {
         wc_add_order_item_meta( $_POST['orderData'], 'libanpost_send_project', '');
    }
}
add_action( 'wp_ajax_remove_order', 'libanpost_remove_order' );