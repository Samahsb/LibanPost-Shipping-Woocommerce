<?php

function libanpost_send_order() {
	wp_send_json('yes');
}
add_action( 'wp_ajax_libanpost_send_order', 'libanpost_send_order' );