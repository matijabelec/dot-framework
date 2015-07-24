<?php

/***********/
/*** MVC ***/
/***********/
interface Listable {
    public function get_data();
}

interface Pageable {
    public function get_items($limit, $offset);
    public function get_items_per_page();
    public function get_current_page();
    public function get_results_number();
}

interface Searchable {
    public function set_criteria($criteria);
}

?>