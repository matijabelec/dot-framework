<?php

class Load {
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
}

?>