<?php

class Webpage_model extends Model implements iWebpage {
    private $data;
    
    public function __construct(array $data=null) {
        if(!is_null($data) )
            $this->data = $data;
    }
    
    public function add_data($key, $val) {
        if(isset($key) && isset($val) )
            $this->data[$key] = $val;
    }
    
    public function get_data() {
        if(!isset($this->data) )
            return null;
        return $this->data;
    }
    
    public function load_lang_data($langfile, $lang) {
        $data = Loader::get_langfile($langfile, $lang);
        if(is_null($data) )
            return false;
        foreach($data as $key => $val) {
            $this->data[$key] = $val;
        }
        return true;
    }
}

?>