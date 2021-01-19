<?php
/**
 * register LibanPost projects page
 */
function libanpost_register_project_page() {
    add_submenu_page( 'woocommerce', 'LibanPost Projects', 'LibanPost Projects', 'manage_options', 'libanpost-projects', 'libanpost_project_page_callback', 2 );
}
function libanpost_project_page_callback() {
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline libanpost-heading">LibanPost Projects</h1>
        <a href="<?php echo admin_url('admin.php?page=libanpost-bulk-orders'); ?>" class="page-title-action">Send LibanPost Bulk Orders</a>
    </div>
    <?php
    $url = admin_url('admin.php?page=libanpost-projects');
}
add_action('admin_menu', 'libanpost_register_project_page',99);

/**
 * register LibanPost bulk orders page
 */
function libanpost_register_bulk_orders_page() {
    add_submenu_page( 'woocommerce', 'LibanPost Bulk Orders', 'LibanPost Bulk Orders', 'manage_options', 'libanpost-bulk-orders', 'libanpost_bulk_orders_page_callback', 3 );
}
function libanpost_bulk_orders_page_callback() {
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline libanpost-heading">LibanPost Bulk Orders</h1>
        <a href="#" class="page-title-action">Send LibanPost Bulk Orders</a>
    </div>
    <?php
}
add_action('admin_menu', 'libanpost_register_bulk_orders_page',99);