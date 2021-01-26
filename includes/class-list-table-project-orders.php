<?php

class LibanPost_Project_Orders extends WP_List_Table {

    public function prepare_items() {

	    $orders = wc_get_orders( array(
            'limit' => -1,
            'type'=> 'shop_order',
		    'orderby'   => 'date',
		    'order'     => 'DESC',
		    'meta_query' => array(
		        'relation' => 'OR',
			    array(
				    'key' => 'var_rate',
                    'value'   => 'libanpost_shipping_nb',
                    'compare' => '!=',
			    ),
                array(
                    'key' => 'libanpost_sent_project',
                    'value'   => '',
                    'compare' => '='
                )
		    )
	    ));

	    foreach ( $orders as $order ) {
		    $row['id']           = $order->get_id();
		    $row['name']         = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
		    $row['email']        = $order->get_billing_email();
		    $row['libanpost-nb'] = wc_get_order_item_meta( $order->get_id(), 'libanpost_shipping_nb', true );

		    $data[] = $row;
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
            "libanpost-nb" => "LibanPost Order Number"
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