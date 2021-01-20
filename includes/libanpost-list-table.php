<?php

require_once (ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

class LibanPostTableClass extends WP_List_Table {
    var $data = array (
        array("id" => 1, "name" => "Samah", "email" => "samah@gmail.com", "libanpost order number" => 1234),
        array("id" => 2, "name" => "Samah", "email" => "samah@gmail.com", "libanpost order number" => 1234),
        array("id" => 3, "name" => "Samah", "email" => "samah@gmail.com", "libanpost order number" => 1234),
        array("id" => 4, "name" => "Samah", "email" => "samah@gmail.com", "libanpost order number" => 1234)
    );

    public function prepare_items() {
        $this->items = $this->data;
        $columns = $this->get_columns();
        $this->_column_headers = array($columns);
    }
    public function get_columns() {
        $columns = array(
            "id" => "ID",
            "name" => "Name",
            "email" => "Email",
            "libanpost order number" => "LibanPost Order Number"
        );
        return $columns;
    }
    public function column_default($item, $column_name) {
        switch ($column_name) {
            case 'id':
            case 'name' :
            case 'email' :
            case 'libanpost order number' :
                return $item[$column_name];
            default :
                return 'no value';
        }
    }
}

//function libanpost_list_table_layout() {
    $libanpost_list_table = new LibanPostTableClass();
    $libanpost_list_table->prepare_items();
    $libanpost_list_table->display();
//}
//libanpost_list_table_layout();