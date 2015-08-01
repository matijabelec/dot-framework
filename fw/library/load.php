<?php

class Load {
    public function model($name) {
        $model = $name . 'Model';
        
        $file = APP_MODELS . $name . '.php';
        if(is_readable($file) ) {
            require_once($file);
            
            if(class_exists($model) ) {
                return new $model;
            }
        }
        
        return false;
    }
    
    public function view($name) {
        $view = $name . 'View';
        
        $file = APP_VIEWS . $name . '.php';
        if(is_readable($file) ) {
            require_once($file);
            
            if(class_exists($view) ) {
                return new $view;
            }
        }
        
        return false;
    }
    
    public function controller($name) {
        $controller = $name . 'Controller';
        
        $file = APP_VIEWS . $name . '.php';
        if(is_readable($file) ) {
            require_once($file);
            
            if(class_exists($controller) ) {
                return new $controller;
            }
        }
        
        return false;
    }
    
    public function template($name) {
        $template = $name;
        
        $file = APP_TEMPLATES . $template . '.tpl';
        if(is_readable($file) ) {
            return file_get_contents($file);
        }
        
        return false;
    }
}

?>