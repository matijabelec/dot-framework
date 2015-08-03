<?php

/**
 * Load class file
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
 * Class used to load resources
 * 
 * Every loading of model, view or controller is done through this class.
 * 
 * Also, load can load a template or mlf file.
 * 
 * Any wrong data (file not exists or not readable), or class not exists result in exception been thrown.
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
class Load {
    
    /**
     * Used to load a model
     * 
     * @param string $name an string representing name of model
     * @return BaseModel an exception is thrown if file is not readable or class not found
     * @access public
     */
    public function model($name) {
        
        /*
         * Model name which can be loaded must start with uppercase letter and end with string 'Model'.
         */
        $model = ucfirst($name) . 'Model';
        
        /*
         * Create string representing path to model file and try to read file (if file is readable).
         */
        $file = APP_MODELS . strtolower($model) . '.php';
        if(is_readable($file) ) {
            require_once($file);
            
            /*
             * Check if class is loaded.
             */
            if(class_exists($model) ) {
                return new $model;
            }
        }
        
        /*
         * If file is not found or not readable, or model class is not loaded, throw an exception.
         */
        throw new Exception('Model "' . $model . '" does not exists or cannot be loaded.');
    }
    
    /**
     * Used to load a view
     * 
     * @param string $name an string representing name of view
     * @return BaseView an exception is thrown if file is not readable or class not found
     * @access public
     */
    public function view($name) {
        
        /*
         * View name which can be loaded must start with uppercase letter and end with string 'View'.
         */
        $view = ucfirst($name) . 'View';
        
        /*
         * Create string representing path to view file and try to read file (if file is readable).
         */
        $file = APP_VIEWS . strtolower($view) . '.php';
        if(is_readable($file) ) {
            require_once($file);
            
            /*
             * Check if class is loaded.
             */
            if(class_exists($view) ) {
                return new $view;
            }
        }
        
        /*
         * If file is not found or not readable, or view class is not loaded, throw an exception.
         */
        throw new Exception('View "' . $view . '" does not exists or cannot be loaded.');
    }
    
    /**
     * Used to load a controller
     * 
     * @param string $name an string representing name of controller
     * @return BaseController an exception is thrown if file is not readable or class not found
     * @access public
     */
    public function controller($name) {
        
        /*
         * Controller name which can be loaded must start with uppercase letter and end with string 
         * 'Controller'.
         */
        $controller = ucfirst($name) . 'Controller';
        
        /*
         * Create string representing path to cotroller file and try to read file (if file is readable).
         */
        $file = APP_VIEWS . strtolower($controller) . '.php';
        if(is_readable($file) ) {
            require_once($file);
            
            /*
             * Check if class is loaded.
             */
            if(class_exists($controller) ) {
                return new $controller;
            }
        }
        
        /*
         * If file is not found or not readable, or controller class is not loaded, throw an exception.
         */
        throw new Exception('Controller "' . $controller . '" does not exists or cannot be loaded.');
    }
    
    /**
     * Used to load a template
     * 
     * @param string $template an string representing name of template or template string
     * @param boolean $inline set to true if template string is used
     * @return Template an exception is thrown if file is not readable
     * @access public
     */
    public function template($template, $inline=false) {
        
        /*
         * If $inline is set to false, try to load template from file.
         */
        if($inline == false) {
            
            /*
             * Create string representing path to template file and try to read file (if file is readable).
             */
            $file = APP_TEMPLATES . $template . '.tpl';
            if(is_readable($file) ) {
                return new Template(file_get_contents($file) );
            }
        } else {
            
            /*
             * Return new template based on $template argument (which, in this case, represent an string 
             * data of template).
             */
            return new Template($template);
        }
        
        /*
         * If file is not found or not readable return an exception. If $inline is set to True, no 
         * exception will be thrown.
         */
        throw new Exception('Template "' . $template . '" does not exists or cannot be loaded.');
    }
}

?>