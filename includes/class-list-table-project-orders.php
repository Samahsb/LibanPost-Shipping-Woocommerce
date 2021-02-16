<?php

class LibanPost_Project_Orders extends WP_List_Table {

    public function single_row( $item ) {
        echo '<tr id="order-' . $item['id'] . '">';
        $this->single_row_columns( $item );
        echo '</tr>';
    }

    public function prepare_items() {

//	    $orders = wc_get_orders( array(
//            'limit' => -1,
//            'type'=> 'shop_order',
//		    'orderby'   => 'date',
//		    'order'     => 'DESC',
//	    ));
        global $wpdb;
        $libanpost_orders = $wpdb->get_results(
            "SELECT order_item_id
	        FROM {$wpdb->prefix}woocommerce_order_itemmeta
	        WHERE meta_key = 'libanpost_shipping_nb'
	        AND meta_value != ''
	        AND order_item_id NOT IN
	        (SELECT order_item_id
	         FROM yt48_dal_woocommerce_order_itemmeta
	         WHERE meta_key = 'libanpost_project_id'
	         AND meta_value != '')
	        "
        );

	    foreach ( $libanpost_orders as $order ) {
		    if (
		    	! empty ( wc_get_order_item_meta( $order->get_id(), 'libanpost_shipping_nb', true ) )
			    &&  empty ( wc_get_order_item_meta( $order->get_id(), 'libanpost_project_id', true ) )
		    ) {
			    $row['id']           = $order->get_id();
			    $row['name']         = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
			    $row['email']        = $order->get_billing_email();
			    $row['libanpost-nb'] = wc_get_order_item_meta( $order->get_id(), 'libanpost_shipping_nb', true );
                $row['remove-submitted-order'] = '<input type="button" class="libanpost-remove-btn" onclick="removeOrder(' . $order->get_id() . ')" value="Remove"><span class="libanpost-loader-remove-btn libanpost-loader-remove-btn-additional-property" id="libanpost_loader_remove_btn_' . $order->get_id() . '"></span>';

			    $data[] = $row;
		    }
	    }

        $columns = $this->get_columns();
        $this->_column_headers = array($columns);

	    $per_page = 50;
	    $current_page = $this->get_pagenum();
	    $total_items = count( $data );
	    $data = array_slice( $data, ( ( $current_page - 1 ) * $per_page ), $per_page );
	    $this->items = $data;

	    $this->set_pagination_args( array(
		    'total_items' => $total_items,
		    'per_page'    => $per_page,
		    'total_pages' => ceil( $total_items / $per_page ),
	    ) );
    }

    public function get_columns() {
        $columns = array(
            "id" => "Order ID",
            "name" => "Name",
            "email" => "Email",
            "libanpost-nb" => "LibanPost Order Number",
            "remove-submitted-order" => ""
        );
        return $columns;
    }

	public function no_items() {
    	echo "No submitted orders";
	}

    public function column_default($item, $column_name) {
        switch ($column_name) {
            default:
                return $item[$column_name];
        }
    }
}