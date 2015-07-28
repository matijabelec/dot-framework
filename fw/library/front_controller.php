<?php

class Route {
    private $route = null;
    private $controller = null;
    private $action = null;
    
    private function __construct($route, $controller, $action) {
        $this->route = $route;
        $this->controller = $controller;
        $this->action = $action;
    }
    
    public static function create($route, $controller, $action) {
        return self::__constructor($route, $controller, $action);
    }
    
    public function getRoute() {
        return $this->route;
    }
    public function getController() {
        return $this->controller;
    }
    public function getAction() {
        return $this->action;
    }
}

class FrontController {
    public function __construct() {
        
    }
    
    public function index($route) {
        $model = 'testpage_model';
        $controller = 'testpage_controller';
        $view = 'homepage_view';
        $action = 'index';
        $args = array();
        
        
        /* model */
        $m = new $model();
        
        
        /* controler */
        $c = new $controller($m);
        
        $RC = new ReflectionClass($c);
        $argnValid = $RC->getMethod($action)->getNumberOfRequiredParameters();
        $argnMax = $RC->getMethod($action)->getNumberOfParameters();
        $argn = count($args);
        if($argn==0 && $argnValid==0)
            $c->$action();
        else if($argn>0 && $argn>=$argnValid && $argn<=$argnMax)
            call_user_func_array(array($c, $action), $args);
        
        
        /* view */
        $v = new $view($c, $m);
        echo $v->output();
    }
}

?>