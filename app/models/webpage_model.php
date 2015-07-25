<?php

class Webpage_model extends Model implements iWebpage {
    private $data;
    
    public function __construct(array $data=null) {
        if(!is_null($data) )
            $this->data = $data;
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