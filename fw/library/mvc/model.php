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
    protected $registry;
    protected $load;
    
    private $storage;
    
    public function __construct() {
        $this->registry = Registry::getInstance();
        $this->load = new Load;
    }
    
    public function __set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    public function __get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
    
    public function set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    public function get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
}

?>