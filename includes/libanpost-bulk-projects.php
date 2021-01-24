<?php
/**
 * register LibanPost list of projects page
 */
function libanpost_register_menu_items() {
    //add_submenu_page( 'woocommerce', 'LibanPost Projects List', 'LibanPost Projects List', 'manage_options', 'libanpost-projects-list', 'libanpost_project_list_page_callback', 2 );
	add_submenu_page( 'woocommerce', 'Submit LibanPost Project', 'Submit LibanPost Project', 'manage_options', 'submit-libanpost-project', 'libanpost_submit_project_page_callback', 3 );
}
add_action( 'admin_menu', 'libanpost_register_menu_items' );

function libanpost_project_list_page_callback() {
	include dirname(__FILE__) . '/views/projects-list.php';
}

function libanpost_submit_project_page_callback() {
	$project_orders = new LibanPost_Project_Orders();
	$project_orders->prepare_items();
	include dirname(__FILE__) . '/views/submit-project.php';
}
