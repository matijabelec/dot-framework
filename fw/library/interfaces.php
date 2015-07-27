<?php

/* model */
interface iPageable {
    public function get_page_records($limit, $offset);
    public function get_per_page();
    public function get_current_page();
    public function get_records_max_count();
}


interface iListable {
    public function get_records();
}


interface iWebpage {
    public function get_data();
    public function load_lang_data($langfile, $lang);
}


/* controller */
interface iSearchable {
    public function set_criteria($criteria);
}


interface iEditable {
    public function create();
    public function read();
    public function update();
    public function delete();
}

?>