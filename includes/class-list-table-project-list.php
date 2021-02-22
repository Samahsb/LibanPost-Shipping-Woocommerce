<?php

class LibanPost_Projects_List extends WP_List_Table {

    public function prepare_items() {

        global $wpdb;
        $orders = $wpdb->get_results(
            "SELECT DISTINCT order_item_id
	         FROM {$wpdb->prefix}woocommerce_order_itemmeta
	         WHERE meta_key = 'libanpost_project_id'
	        "
        );

        $numberOfOrders = $wpdb->get_results(
            "SELECT COUNT(*), order_item_id
	         FROM {$wpdb->prefix}woocommerce_order_itemmeta
	         WHERE meta_key = 'libanpost_project_id"
        );
var_dump($numberOfOrders);
        foreach ( $orders as $order ) {
            $order = wc_get_order( $order->order_item_id );
            {
                $row['id']           = wc_get_order_item_meta( $order->get_id(), 'libanpost_project_id', true );
                $row['number']         = 5;
                $row['date']        = 6;

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
            "id" => "Project ID",
            "number" => "Number of submitted orders",
            "date" => "Date"
        );
        return $columns;
    }

    public function no_items() {
        echo "No submitted projects";
    }

    public function column_default($item, $column_name) {
        switch ($column_name) {
            default:
                return $item[$column_name];
        }
    }
}