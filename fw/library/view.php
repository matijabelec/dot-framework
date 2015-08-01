<?php

class BaseView {
    protected $registry;
    protected $load;
    
    public function __construct() {
        $this->registry = Registry::getInstance();
        $this->load = new Load;
    }
    
    public function output() {
        return '';
    }
}

?>