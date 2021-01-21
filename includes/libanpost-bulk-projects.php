<?php
/**
 * register LibanPost list of projects page
 */
function libanpost_register_projects_list_page() {
    add_submenu_page( 'woocommerce', 'LibanPost Projects List', 'LibanPost Projects List', 'manage_options', 'libanpost-projects-list', 'libanpost_project_page_callback', 2 );
}
function libanpost_project_page_callback() {
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline libanpost-heading">LibanPost Projects List</h1>
        <a href="<?php echo admin_url('admin.php?page=submit-libanpost-project'); ?>" class="page-title-action">Send LibanPost Project</a>
    </div>
    <?php
    $url = admin_url('admin.php?page=libanpost-projects');
}
add_action('admin_menu', 'libanpost_register_projects_list_page',99);

/**
 * register LibanPost submit project page
 */
function libanpost_register_submit_project_page() {
    add_submenu_page( 'woocommerce', 'Submit LibanPost Project', 'Submit LibanPost Project', 'manage_options', 'submit-libanpost-project', 'libanpost_submit_project_page_callback', 3 );
}
function libanpost_submit_project_page_callback() {
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline libanpost-heading">Submit LibanPost Project</h1>
    <?php
    include_once dirname( __FILE__ ) . '/libanpost-list-table.php';
    ?>
        <input type="button" value="Submit Project" class="button-primary" style="float: right;" onclick="submitLibanPostProject()">
    </div>
    <?php
}
add_action('admin_menu', 'libanpost_register_submit_project_page',99);
