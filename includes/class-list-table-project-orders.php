<?php

class LibanPost_Project_Orders extends WP_List_Table {

    public function single_row( $item ) {
        echo '<tr id="order-' . $item['id'] . '">';
        $this->single_row_columns( $item );
        echo '</tr>';
    }

    public function prepare_items() {

	    $orders = wc_get_orders( array(
            'limit' => -1,
            'type'=> 'shop_order',
		    'orderby'   => 'date',
		    'order'     => 'DESC',
	    ));

	    foreach ( $orders as $order ) {
		    if (
		    	! empty ( wc_get_order_item_meta( $order->get_id(), 'libanpost_shipping_nb', true ) )
			    &&  empty ( wc_get_order_item_meta( $order->get_id(), 'libanpost_send_project', true ) )
		    ) {
			    $row['id']           = $order->get_id();
			    $row['name']         = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
			    $row['email']        = $order->get_billing_email();
			    $row['libanpost-nb'] = wc_get_order_item_meta( $order->get_id(), 'libanpost_shipping_nb', true );
                $row['remove-submitted-order'] = '<input type="button" class="libanpost-remove-btn" id="libanpost-remove-btn" onclick="removeOrder(' . $order->get_id() . ')" value="Remove">';

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