<?php
/**
 * register LibanPost submenu page
 */
function libanpost_register_submenu_page() {
    add_submenu_page( 'woocommerce', 'LibanPost Projects', 'LibanPost Projects', 'manage_options', 'libanpost-submenu-page', 'libanpost_submenu_page_callback', 2 );
}
function libanpost_submenu_page_callback() {
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline libanpost-heading">LibanPost Bulk Projects</h1>
        <a href="#" class="page-title-action">Send LibanPost Bulk Orders</a>
    </div>
    <?php
    $url = admin_url('admin.php?page=libanpost-submenu-page');
}
add_action('admin_menu', 'libanpost_register_submenu_page',99);

/**
 * add LibanPost submenu page
 */
function libanpost_add_submenu_page() {
    add_submenu_page( 'libanpost-submenu-page', 'LibanPost add Projects', 'LibanPost add Projects', 'manage_options', 'libanpost-add-submenu-page', 'libanpost_add_submenu_page_callback', 2 );
}
function libanpost_add_submenu_page_callback() {
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline libanpost-heading">LibanPost Bulk Projects</h1>
        <a href="#" class="page-title-action">Send LibanPost Bulk Orders</a>
    </div>
    <?php
}
add_action('admin_menu', 'libanpost_add_submenu_page',99);
