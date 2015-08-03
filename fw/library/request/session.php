<?php

/**
 * Session class file
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
 * Class used to work with session
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
class Session {
    
    /**
     * @var Session
     * @access private
     * @static
     */
    private static $instance;
    
    
    /**
     * @var string
     * @access private
     * @static
     */
    private static $name;
    
    /**
     * @var array
     * @access private
     */
    private $storage;
    
    /**
     * Used to start an session with a name
     * 
     * @param string $name 
     * @access public
     * @static
     */
    public static function start($name) {
        self::$name = $name;
        session_name(self::$name);
        session_start();
    }
    
    /**
     * Constructor is private. Class is singleton.
     * 
     * @access private
     */
    private function __construct() {
        foreach($_SESSION as $name=>&$val) {
            $this->set($name, $val);
        }
    }
    
    /**
     * Used to get an instance of Session
     * 
     * @return Session
     * @access public
     * @access static
     */
    public static function getInstance() {
        if(!self::$instance instanceof self) {
            self::$instance = new Session;
        }
        return self::$instance;
    }
    
    /**
     * Used to set a key in session
     * 
     * @param string $key 
     * @param mixed $val 
     * @access public
     */
    public function __set($key, $val) {
        $_SESSION[$key] = $val;
        $this->storage[$key] = $val;
    }
    
    /**
     * Used to unset a key in session
     * 
     * @param string $key 
     * @access public
     */
    public function __unset($key) {
        unset($_SESSION[$key]);
        unset($this->storage[$key]);
    }
    
    /**
     * Used to check if key is set in session
     * 
     * @param string $key 
     * @return boolean 
     * @access public
     */
    public function __isset($key) {
        return isset($this->storage[$key]);
    }
    
    /**
     * Used to get value of key in session
     * 
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
     * Used to set a key in session
     * 
     * @param string $key 
     * @param mixed $val 
     * @access public
     */
    public function set($key, $val) {
         $_SESSION[$key] = $val;
         $this->storage[$key] = $val;
    }
    
    /**
     * Used to get value of key in session
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
    
    /**
     * Used to destroy an session
     * 
     * @access public 
     * @static
     */
    public static function destroy() {
        session_destroy();
    }
}

?>