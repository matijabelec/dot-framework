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
    
    /**
     * Represents one minute in seconds
     * @var integer
     * @const
     */
    const TIME_MINUTE = 60;
    
    /**
     * Represents one hour in seconds
     * @var integer
     * @const
     */
    const TIME_HOUR = 3600;
    
    /**
     * Represents one day in seconds
     * @var integer
     * @const
     */
    const TIME_DAY = 86400;
    
    /**
     * Represents one month in seconds (as 30 days)
     * @var integer
     * @const
     */
    const TIME_MONTH = 2592000;
    
    /**
     * Represents one year in seconds (as 365 days)
     * @var integer
     * @const
     */
    const TIME_YEAR = 31536000;
    
    /**
     * @var Cookie
     * @access private
     * @static
     */
    private static $instance;
    
    /**
     * @var array
     * @access private
     */
    private $storage;
    
    /**
     * Constructor is set private as this class is singleton
     * 
     * @access private
     */
    private function __construct() {
        foreach($_COOKIE as $name=>&$val) {
            $this->set($name, $val);
        }
    }
    
    /**
     * Used to get instance of Cookie
     * 
     * @return Cookie 
     * @access public
     * @static
     */
    public static function getInstance() {
        if(!self::$instance instanceof self) {
            self::$instance = new Cookie;
        }
        return self::$instance;
    }
    
    /**
     * Magic method used to set variables
     * 
     * @param string $key 
     * @param string $val 
     * @access public
     */
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
    
    /**
     * Magic method used to unset variable and cookie with same name
     * 
     * @param string $key 
     * @access public
     */
    public function __unset($key) {
        unset($_COOKIE[$key]);
        unset($this->storage[$key]);
    }
    
    /**
     * Used to test if cookie is set
     * 
     * @param string $key 
     * @return boolean 
     * @access public
     */
    public function __isset($key) {
        return isset($this->storage[$key]);
    }
    
    /**
     * Used to get cookie value
     * @param string $key 
     * @return mixed|null
     * @access public
     */
    public function __get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
    
    /**
     * Used to set cookie
     * 
     * @param string $key 
     * @param string $value 
     * @param integer $expire 
     * @param string $path 
     * @param string|null $domain 
     * @param boolean $secure 
     * @param boolean $httponly 
     * @access public
     */
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
    
    /**
     * Used to set rawcookie
     * 
     * @param string $key 
     * @param string $value 
     * @param integer $expire 
     * @param string $path 
     * @param string|null $domain 
     * @param boolean $secure 
     * @param boolean $httponly 
     * @access public
     */
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
    
    /**
     * Used to get cookie value
     * 
     * @param string $key 
     * @return mixed|null
     * @access public
     */
    public function get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
}

?>