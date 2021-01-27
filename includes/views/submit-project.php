<div class="wrap">
	<h1 class="wp-heading-inline libanpost-heading"><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <pre>
        <?php
        var_dump($project_orders->items);
        ?>
    </pre>
    <script>
        let dataItems = 'ssss';
    </script>
	<form id="" method="get">
		<?php $project_orders->display();
        $ERPCode = get_option("wc_settings_tab_erpcode");
        ?>
        <input type="text" style="display: none" id="erpCode" value="<?php echo $ERPCode ?>">
        <div class="submit-project">
            <input type="button" value="Submit Project" onclick="submitLibanPostProject()" class="button-primary">
            <div class="libanpost-ajax-response">
                <div id="projectResponse"></div>
                <div class="libanpost-loader" id="projectLoader"></div>
            </div>
        </div>
    </form>
</div>