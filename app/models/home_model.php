<?php

/*
 * webpage
 *      add_css
 *      add_js
 *      
 *      add_section
 *      
 *      
 *      get_data
 */

class Home_model extends Model implements Webpage {
    private $data;
    
    public function __construct() {
        $this->data = array(
                        'title'=>'Home',
                        'content'=>'- no content -');
    }
    
    public function add_data($key, $val) {
        $this->data[$key] = $val;
    }
    
    public function get_data() {
        if(!isset($this->data) )
            return null;
        return $this->data;
    }
}

?>