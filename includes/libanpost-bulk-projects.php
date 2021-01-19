<?php
/**
 * register LibanPost submenu page
 */
function libanpost_register_submenu_page() {
    add_submenu_page( 'woocommerce', 'LibanPost Projects', 'LibanPost Projects', 'manage_options', 'libanpost-submenu-page', 'libanpost_submenu_page_callback', 2 );
}
function libanpost_submenu_page_callback() {
    echo '<h3>Test</h3>';
}
add_action('admin_menu', 'libanpost_register_submenu_page',99);