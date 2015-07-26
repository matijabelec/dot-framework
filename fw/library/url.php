<?php

class Url {
    public static function get($key) {
        if(isset($key) && isset($_GET[$key]) )
            return $_GET[$key];
        return null;
    }
    
    public static function post($key) {
        if(isset($key) && isset($_POST[$key]) )
            return $_POST[$key];
        return null;
    }
}

?>