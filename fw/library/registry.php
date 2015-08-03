<?php

/**
 * Registry class file
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
 * Class which represents main registry in application
 * 
 * Class is singleton. It is the main repository for transporting values of variables in between other 
 * objects in application instead of using global variables.
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
class Registry {
    
    /**
     * @var Registry
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
     * Constructor is private (class is singleton)
     * 
     * @access private
     */
    private function __construct() {}
    
    /**
     * Static method used to get an instance of Registry
     * 
     * @return Registry
     * @access public
     * @static
     */
    public static function getInstance() {
        if(!self::$instance instanceof self) {
            self::$instance = new Registry;
        }
        return self::$instance;
    }
    
    /**
     * Magic method used to set an variable 
     * 
     * @param string $key 
     * @param string $val 
     * @access public
     */
    public function __set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    /**
     * Magic method used to get a value from variable 
     * 
     * @param string $key 
     * @return mixed|null an value of variable or NULL if variable not exists
     * @access public
     */
    public function __get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
}

?>