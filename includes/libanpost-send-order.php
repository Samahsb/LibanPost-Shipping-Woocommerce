<?php

function libanpost_send_order() {

	$request_data = $_POST['orderData'];
	$request_url = "https://hemi.Libanpost.com/api/PKOrder?token=Token_Given&ERPCode=ERP";

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

	wp_send_json($response);
}
add_action( 'wp_ajax_libanpost_send_order', 'libanpost_send_order' );