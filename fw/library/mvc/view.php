<?php

/**
 * BaseView class file
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
 * Class which represents a base view in MVC
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
class BaseView {
    
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
    
    /**
     * Used to check if variable (key) is of class (class)
     * 
     * @param string $key representing variable
     * @param string $class representing class name
     * @return - or exception if key not of class $class
     * @access protected
     * @final
     */
    final protected function checkInstance($key, $class) {
        if(!isset($key) || !is_a($key, $class) ) {
            throw new Exception('View->CheckInstance failed.');
        }
    }
    
    /**
     * Used to render a view
     * 
     * Returns string representing viewable content (usualy html formated string).
     * 
     * @return string
     * @access public
     */
    public function render() {
        return '';
    }
}

?>