<?php

class Request {
    private $controller;
    private $action;
    private $args;
    
    public function __construct() {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $uri = array_filter($uri);
        
        for($i=0; $i<REQUEST_FIRST_PARAM; $i++) array_shift($uri);
        
        $this->controller = ($c=array_shift($uri) ) ? $c : 'index';
        $this->action = ($a=array_shift($uri) ) ? $a : 'index';
        $this->args = isset($uri) ? $uri : [];
    }
    
    public function getController() {
        return $this->controller;
    }
    
    public function getAction() {
        return $this->action;
    }
    
    public function getArgs() {
        return $this->args;
    }
}

?>