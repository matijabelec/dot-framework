<?php

class Session {
    private static $instance;
    private static $name;
    private $storage;
    
    public static function start($name) {
        self::$name = $name;
        session_name(self::$name);
        session_start();
    }
    
    private function __construct() {}
    
    public static function getInstance() {
        if(!self::$instance instanceof self) {
            self::$instance = new Session;
        }
        return self::$instance;
    }
    
    public function __set($key, $val) {
        $_SESSION[$key] = $val;
        $this->storage[$key] = $val;
    }
    
    public function __unset($key) {
        unset($_SESSION[$key]);
        unset($this->storage[$key]);
    }
    
    public function __get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        throw new Exception('Session has no data with key "' . $key . '".');
    }
    
    public function set($key, $val) {
         $_SESSION[$key] = $val;
         $this->storage[$key] = $val;
    }
    
    public static function get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        throw new Exception('Session has no data with key "' . $key . '".');
    }
    
    public function destroy() {
        session_destroy();
    }
}

?>