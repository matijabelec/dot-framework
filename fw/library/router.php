<?php

/**
 * Router class file
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
 * Class used for route operations
 * 
 * Primarily this class is used to start "front controller". This is first controller which is created on 
 * application load.
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
class Router {
    
    /**
     * Used to transform Request to Controller
     * 
     * All possible controller to which router can route must ends with string 'Controller'. Also, all 
     * actions (methods of controller's class must ends with string 'Action').
     * Arguments (if any) are sent to action.
     * 
     * @param \Request $request 
     * @return - or exception if controller is not found or action cannot be called (method not exists or it 
     *          is not public)
     * @access public
     * @static
     */
    public static function route(Request $request) {
        
        /*
         * Create names for controller and action. 
         * Controller's class name starts with uppercase letter and ends with 'Controller'.
         * Action is a string representing method name and must end with string 'Action'.
         * Arguments are represented with array.
         */
        $controller = ucfirst($request->getController() ) . 'Controller';
        $action = $request->getAction() . 'Action';
        $args = $request->getArgs();
        
        /*
         * Try to load a controller. Creates a filename depending on controller name and tries to read file 
         * with class in it.
         */
        $file = APP_CONTROLLERS . strtolower($controller) . '.php';
        if(is_readable($file) ) {
            require_once($file);
            
            /*
             * If class is not in file exception at end of method will be thrown, or, if class exists 
             * proceed.
             */
            if(class_exists($controller) ) {
                
                /*
                 * Create controller from string.
                 */
                $controller = new $controller;
                
                /*
                 * Check if action exists and can be called.
                 */
                if(is_callable([$controller, $action]) ) {
                    
                    /*
                     * Select call of action with or without arguments. If $args is not empty array then call 
                     * method with argument, or in other case, call method without any argument.
                     */
                    if(!empty($args) ) {
                        call_user_func_array([$controller, $action], $args);
                    } else {
                        call_user_func([$controller, $action]);
                    }
                    
                    /*
                     * If controller is found and action is found then return from method at this point (any 
                     * other ways will result with exception been thrown).
                     */
                    return;
                }
            }
        }
        
        /*
         * Throw exception if controller is not found or action cannot be called (eather method not exists 
         * or access is restricted).
         */
        throw new Exception('Controller "' . $request->getController() . 'Controller"' . 
                            ' or action "' . $request->getAction() . 'Action" not found.');
    }
}

?>