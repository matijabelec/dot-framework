<?php

/***********/
/*** MVC ***/
/***********/
interface iListable {
    public function get_item();
}

interface iPageable {
    public function get_items($limit, $offset);
    public function get_items_per_page();
    public function get_current_page();
    public function get_results_number();
}

interface iSearchable {
    public function set_criteria($criteria);
}

interface iWebpage {
    public function add_data($key, $val);
    public function get_data();
}


?>