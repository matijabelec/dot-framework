<?php

class Session {
    protected function __construct() {}
    
    public static function start($name='SESS_DFW_UNK') {
        session_name($name);
        session_start();
    }
    
    public static function destroy() {
        session_destroy();
    }
    
    public static function set($key, $val) {
        if(isset($key) && isset($val) )
            $_SESSION[$key] = $val;
    }
    
    public static function get($key) {
        if(isset($key) && isset($_SESSION[$key]) )
            return $_SESSION[$key];
        return null;
    }
}

?>