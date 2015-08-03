<?php

/**
 * Class Router used for routing in Dot-framework
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
 * Class used to route to controller
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
class Router {
    
    /**
     * Used to transform Request to Controller
     * 
     * All possible controller to which router can route must ends with 
     * string 'Controller'. Also, all actions (methods of controller's 
     * class must ends with string 'Action').
     * 
     * Arguments (if any) are sent to action.
     * 
     * @param \Request $request 
     * @return  |exception if controller is not found or action cannot be
     *                     called (method not exists or it is not public)
     * @access public
     * @static
     */
    public static function route(Request $request) {
        /*
         * create names for: 
         * $controller: controller's class name starts with uppercase 
         *              letter and ends with 'Controller'
         * $action: must end with string 'Action'
         * $args: is represented with array
         */
        $controller = ucfirst($request->getController() ) . 'Controller';
        $action = $request->getAction() . 'Action';
        $args = $request->getArgs();
        
        /*
         * try to load a controller
         * 
         * creates a filename depending on controller name and tries to 
         * read file with class in it
         */
        $file = APP_CONTROLLERS . strtolower($controller) . '.php';
        if(is_readable($file) ) {
            require_once($file);
            
            /*
             * if class is not in file exception at end of method will be 
             * thrown, or, if class exists proceed
             */
            if(class_exists($controller) ) {
                /*
                 * create controller
                 */
                $controller = new $controller;
                
                /*
                 * check if action exists and can be called
                 */
                if(is_callable([$controller, $action]) ) {
                    
                    /*
                     * select call of action with or without arguments,
                     * if $args is not empty array - call method with 
                     * argument, or, in other case, call method without 
                     * any argument
                     */
                    if(!empty($args) ) {
                        call_user_func_array([$controller, $action], $args);
                    } else {
                        call_user_func([$controller, $action]);
                    }
                    
                    /*
                     * if controller is found and action is found return 
                     * from method at this point (any other ways will 
                     * result with exception thrown)
                     */
                    return;
                }
            }
        }
        
        /*
         * throw exception if controller is not found or action cannot be
         * called (eather method not exists or access is restricted)
         */
        throw new Exception('Controller "' . $request->getController() . 'Controller"' . 
                            ' or action "' . $request->getAction() . 'Action" not found.');
    }
}

?>