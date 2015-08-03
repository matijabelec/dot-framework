<?php

/**
 * BaseModel class file
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
 * Class which represents a base model in MVC
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
class BaseModel {
    
    /**
     * @var Registry
     * @access protected
     */
    protected $registry;
    
    /**
     * @var Load
     * @access protected
     */
    protected $load;
    
    /**
     * @var array
     * @access private
     */
    private $storage;
    
    /**
     * Default constructor used to set registry and load properties
     * 
     * @access public
     */
    public function __construct() {
        $this->registry = Registry::getInstance();
        $this->load = new Load;
    }
    
    /**
     * Used to set property
     * 
     * @param string $key 
     * @param mixed $val 
     * @access public
     */
    public function __set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    /**
     * Used to get property
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
     * Used to set property
     * 
     * @param string $key 
     * @param mixed $val 
     * @access public
     */
    public function set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    /**
     * Used to get property
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