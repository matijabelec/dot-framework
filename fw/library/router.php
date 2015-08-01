<?php

class Router {
    public static function route(Request $request) {
        $controller = $request->getController() . 'Controller';
        $action = $request->getAction() . 'Action';
        $args = $request->getArgs();
        
        $file = APP_CONTROLLERS . $controller . '.php';
        if(is_readable($file) ) {
            require_once($file);
            if(class_exists($controller) ) {
                $controller = new $controller;
                if(is_callable([$controller, $action]) ) {
                    if(!empty($args) ) {
                        call_user_func_array([$controller, $action], $args);
                    } else {
                        call_user_func([$controller, $action]);
                    }
                    return;
                }
            }
        }
        
        throw new Exception('Controller "' . $request->getController() . '"' . 
                            ' or action "' . $request->getAction() . '" not found.');
    }
}

?>