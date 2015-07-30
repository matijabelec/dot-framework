<?php

class WebpageModel {
    private $data;
    
    public function __construct() {
        $this->data = array('ROOT'=>WEB_ROOT, 
                            'SITE'=>WEB_SITE);
    }
    
    protected function addValue($key, $value) {
        if(isset($key) && isset($value) )
            $this->data[$key] = $value;
    }
    
    protected function addData($data) {
        if(isset($data) && is_array($data) ) {
            foreach($data as $key=>$value)
                $this->data[$key] = $value;
        }
    }
    
    public function getData() {
        if(isset($this->data) && is_array($this->data) )
            return $this->data;
        return array();
    }
}

?>