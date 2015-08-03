<?php

/**
 * Request class file
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
 * Class which represents an request data (REQUEST_URI)
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
class Request {
    
    /**
     * @var string
     * @access private
     */
    private $controller;
    
    /**
     * @var string
     * @access private
     */
    private $action;
    
    /**
     * @var array
     * @access private
     */
    private $args;
    
    /**
     * Constructor used to set default data
     * 
     * It sets names for controller, action. 
     * Sets arguments to empty array or an array of values if more then two parts of URI is found.
     * @access public
     */
    public function __construct() {
        
        /*
         * Explode an REQUEST_URI to get parts of uri. Then, filter array to remove first an last parts if 
         * they are empty strings.
         */
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $uri = array_filter($uri);
        
        /*
         * Remove first N parts depending on configuration. It's primarily usage is when application is not 
         * run from a root directory. In that case it removes directories names as needed.
         */
        for($i=0; $i<REQUEST_FIRST_PARAM; $i++) {
            array_shift($uri);
        }
        
        /*
         * First part is controller name. Second is action name. In both cases if part not exists names gets 
         * they default names.
         * Arguments is set to empty array if there is less than three parts in $uri or it contains all 
         * remained values in $uri as array of values.
         */
        $this->controller = ($c=array_shift($uri) ) ? $c : 'index';
        $this->action = ($a=array_shift($uri) ) ? $a : 'index';
        $this->args = isset($uri) ? $uri : [];
    }
    
    /**
     * Used to get a controller name
     * 
     * @return string
     * @access public
     */
    public function getController() {
        return $this->controller;
    }
    
    /**
     * Used to get an action name
     * 
     * @return string
     * @access public
     */
    public function getAction() {
        return $this->action;
    }
    
    /**
     * Used to get an arguments
     * 
     * It returns empty array if no arguments set.
     * 
     * @return array
     * @access public
     */
    public function getArgs() {
        return $this->args;
    }
}

?>