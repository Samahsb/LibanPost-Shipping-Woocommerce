<?php

class LibanPost_Projects_List extends WP_List_Table {

    public function prepare_items() {

        global $wpdb;
        $orders = $wpdb->get_results(
            "SELECT DISTINCT meta_value, COUNT(*) AS nb
	         FROM {$wpdb->prefix}woocommerce_order_itemmeta
	         WHERE meta_key = 'libanpost_project_id'
	            GROUP BY meta_value
	        "
        );
        foreach ( $orders as $order ) {
            {
                $row['id']           = $order->meta_value;
                $row['orders']       = $order->nb;
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
            "orders" => "Number Of Submitted Orders",
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