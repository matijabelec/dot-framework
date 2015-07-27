<?php

class Region_model extends Model {
    private $data;
    
    public function __construct($langfile, $lang) {
        $this->data = Loader::get_langfile($langfile, $lang);
    }
    
    public function set($key, $val) {
        if(isset($key) && isset($val) )
            $this->data[$key] = $val;
    }
    
    public function get($key) {
        if(isset($key) && isset($this->data[$key]) )
            return $this->data[$key];
        return null;
    }
    
    public function get_lang_data() {
        if(isset($this->data) && !is_null($this->data) )
            return $this->data;
        return array();
    }
}

?>