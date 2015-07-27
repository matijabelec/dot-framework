<?php

class Webpage_model implements iWebpage {
    private $data = array();
    
    public function get_data() {
        return $this->data;
    }
    public function set_data($key, $value) {
        if(isset($key) && isset($value) )
            $this->data[$key] = $value;
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