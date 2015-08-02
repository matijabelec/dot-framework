<?php

/**
 * Class Load used for loading resources in Dot-framework
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
 * Every loading of model, view or controller is done
 * through this class.
 * 
 * Also, load can load a template or mlf file.
 * 
 * Any wrong data (file not exists or not readable), or
 * class not exists result in exception been thrown.
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
class Load {
    
    /**
     * Used to load a model.
     * 
     * @param string    $arg1 an string representing name of model
     * @return BaseModel an exception is thrown if file is not 
     *                   readable or class not found
     * @access public
     */
    public function model($name) {
        $model = ucfirst($name) . 'Model';
        
        $file = APP_MODELS . strtolower($model) . '.php';
        if(is_readable($file) ) {
            require_once($file);
            
            if(class_exists($model) ) {
                return new $model;
            }
        }
        
        throw new Exception('Model "' . $model . '" does not exists or cannot be loaded.');
    }
    
    /**
     * Used to load a view.
     * 
     * @param string    $arg1 an string representing name of view
     * @return BaseView an exception is thrown if file is not 
     *                  readable or class not found
     * @access public
     */
    public function view($name) {
        $view = ucfirst($name) . 'View';
        
        $file = APP_VIEWS . strtolower($view) . '.php';
        if(is_readable($file) ) {
            require_once($file);
            
            if(class_exists($view) ) {
                return new $view;
            }
        }
        throw new Exception('View "' . $view . '" does not exists or cannot be loaded.');
    }
    
    /**
     * Used to load a controller.
     * 
     * @param string    $arg1 an string representing name of 
     *                        controller
     * @return BaseController an exception is thrown if file is 
     *                        not readable or class not found
     * @access public
     */
    public function controller($name) {
        $controller = ucfirst($name) . 'Controller';
        
        $file = APP_VIEWS . strtolower($controller) . '.php';
        if(is_readable($file) ) {
            require_once($file);
            
            if(class_exists($controller) ) {
                return new $controller;
            }
        }
        
        throw new Exception('Controller "' . $controller . '" does not exists or cannot be loaded.');
    }
    
    /**
     * Used to load a template.
     * 
     * @param string    $arg1 an string representing name of 
     *                        template or template string
     * @param boolean    $arg2 set to true if template string
     *                         is used
     * @return Template an exception is thrown if file is not 
     *                  readable
     * @access public
     */
    public function template($template, $inline=false) {
        if($inline == false) {
            $file = APP_TEMPLATES . $template . '.tpl';
            if(is_readable($file) ) {
                return new Template(file_get_contents($file) );
            }
        } else {
            return new Template($template);
        }
        
        throw new Exception('Template "' . $template . '" does not exists or cannot be loaded.');
    }
    
    /**
     * Used to load a multilangfile (.mlf).
     * 
     * @param string    $arg1 an string representing name of mlf
     * @return MultilangFile an exception is thrown if file is 
     *                       not readable
     * @access public
     */
    public function multilangFile($mlf) {
        $file = APP_MULTILANGS . $mlf . '.mlf';
        if(is_readable($file) ) {
            return new MultilangFile($mlf);
        }
        
        throw new Exception('Multilang file "' . $mlf . '" does not exists or cannot be loaded.');
    }
}

?>