<?php

class BaseView {
    protected $registry;
    protected $load;
    
    private $storage;
    
    public function __construct() {
        $this->registry = Registry::getInstance();
        $this->load = new Load;
    }
    
    public function __set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    public function __get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
    
    public function set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    public function get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
    
    final protected function checkInstance($key, $class) {
        if(!isset($key) || !is_a($key, $class) ) {
            throw new Exception('View->CheckInstance failed.');
        }
    }
    
    public function output() {
        return '';
    }
}

?>