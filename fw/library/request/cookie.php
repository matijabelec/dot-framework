<?php

class Cookie {
    private static $instance;
    private $storage;
    
    private function __construct() {}
    
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
    
    public function __get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        throw new Exception('Cookie has no data with key "' . $key . '".');
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
            $this->storage[$key] = ['value' => $value,
                                'expire' => $expire,
                                'path' => $path,
                                'domain' => $domain,
                                'secure' => $secure,
                                'httponly' => $httponly];
        } else {
            setcookie($key, $value, time()+$expire, $path);
            $this->storage[$key] = ['value' => $value,
                                'expire' => $expire,
                                'path' => $path];
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
            $this->storage[$key] = ['value' => $value,
                                'expire' => $expire,
                                'path' => $path,
                                'domain' => $domain,
                                'secure' => $secure,
                                'httponly' => $httponly,
                                'raw' => true];
        } else {
            setrawcookie($key, $value, time()+$expire, $path);
            $this->storage[$key] = ['value' => $value,
                                'expire' => $expire,
                                'path' => $path,
                                'raw' => true];
        }
    }
    
    public static function get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        throw new Exception('Cookie has no data with key "' . $key . '".');
    }
}

?>