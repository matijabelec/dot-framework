<?php

class Registry {
    private static $instance;
    private $storage;
    
    private function __construct() {}
    
    public static function getInstance(){
        if(!self::$instance instanceof self) {
            self::$instance = new Registry;
        }
        return self::$instance;
    }
    
    public function set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    public function get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return false;
    }
}

?>