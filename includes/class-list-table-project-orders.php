<?php

class LibanPost_Project_Orders extends WP_List_Table {
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