<?php

/**
 * Cookie class file
 * 
 * PHP version 5
 * 
 * LICENSE: 
 *
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */

/**
 * Class used to work with cookies
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
class Cookie {
    private static $instance;
    private $storage;
    
    private function __construct() {
        foreach($_COOKIE as $name=>&$val) {
            $this->set($name, $val);
        }
    }
    
    public static function getInstance() {
        if(!self::$instance instanceof self) {
            self::$instance = new Cookie;
        }
        return self::$instance;
    }
    
    public function __set($key, $val) {
        if(isset($val['value'], 
                 $val['expire'], 
                 $val['path'], 
                 $val['domain'], 
                 $val['secure'], 
                 $val['httponly']) && !is_null($domain) ) {
            
            if(isset($val['raw']) && $val['raw']==true) {
                setrawcookie($name, $value, time()+$expire, $path, $domain, $secure, $httponly);
            } else {
                setcookie($name, $value, time()+$expire, $path, $domain, $secure, $httponly);
            }
        } else if(isset($val['value'], 
                 $val['expire'], 
                 $val['path']) ) {
            if(isset($val['raw']) && $val['raw']==true) {
                setrawcookie($name, $value, time()+$expire, $path, $domain, $secure, $httponly);
            } else {
                setcookie($name, $value, time()+$expire, $path);
            }
        }
        $this->storage[$key] = $val;
    }
    
    public function __unset($key) {
        unset($_COOKIE[$key]);
        unset($this->storage[$key]);
    }
    
    public function __isset($key) {
        return isset($this->storage[$key]);
    }
    
    public function __get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
    
    public function set($key, 
                               $value = '', 
                               $expire = 86400, 
                               $path = '/', 
                               $domain = null, 
                               $secure = false, 
                               $httponly = false) {
        if(isset($domain) && !is_null($domain) ) {
            setcookie($key, $value, time()+$expire, $path, $domain, $secure, $httponly);
            $this->storage[$key] = $value;
        } else {
            setcookie($key, $value, time()+$expire, $path);
            $this->storage[$key] = $value;
        }
    }
    public function setRaw($key, 
                               $value = '', 
                               $expire = 86400, 
                               $path = '/', 
                               $domain = null, 
                               $secure = false, 
                               $httponly = false) {
        if(isset($domain) && !is_null($domain) ) {
            setrawcookie($key, $value, time()+$expire, $path, $domain, $secure, $httponly);
            $this->storage[$key] = $value;
        } else {
            setrawcookie($key, $value, time()+$expire, $path);
            $this->storage[$key] = $value;
        }
    }
    
    public function get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
}

?>