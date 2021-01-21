<div class="wrap">
	<h1 class="wp-heading-inline libanpost-heading"><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form id="" method="get">
		<?php $project_orders->display(); ?>
	</form>
    <p><a href="#" onclick="submitLibanPostProject()" class="button button-primary">Submit Project</a></p>
</div>