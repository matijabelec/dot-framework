<?php

/**
 * FrontController class is used for main controller in Dot-framework
 *
 * FrontController class used for preparing the model, starting the 
 * controller and rendering the view.
 *
 * PHP version 5
 *
 * LICENSE: 
 *
 * @author     Matija Belec <matijabelec1@gmail.com>
 * @copyright  2015 Matija Belec
 * @license    Proprietary
 */

/**
 * FrontController class
 * 
 * This is controller which is first called from router and it then prepare
 * model, new controller and view which will be then called.
 * 
 * First, controller is called by selected action. Then view->output is 
 * called and this is point from where view is rendered on-screen.
 */
class FrontController {
    /**
     * Private constructor because class is static
     * 
     * This private constructor prevents instantiation of this class.
     * 
     * @access private
     * @static
     */
    private function __construct() {}
    
    /**
     * Prepare model and view and run controller
     * 
     * This method is used to start an action on selected Controller 
     * and get view from selected View.
     * 
     * @param string    $arg1 an string representing route.
     * @param &int    $arg2 an status info can have different states: 
     *                          STATUS_ERR if error occured,
     *                          STATUS_OK if all went ok.
     * 
     * @return string an string representig view->output data
     * @access public
     * @static
     */
    public static function index($route, &$status=null) {
        $status = STATUS_OK;
        $debugInfo = 0;
        
        $routeData = Router::getRoute($route);
        if(is_null($routeData) ) {
            $status = STATUS_ERR;
            return '';
        }
        
        $route = $routeData->getRoute();
        $model = $routeData->getModel();
        $controller = $routeData->getController();
        $view = $routeData->getView();
        $action = $routeData->getAction();
        $args = $routeData->getArguments();
        
        if($debugInfo) {
            echo '<div>
    <div style="text-align: left; padding: 4px 10px; border: 1px solid #000">
        route: ' . $route . '<br>
        controller: ' . $controller . '<br>
        action: ' . $action . '<br>
        model: ' . $model . '<br>
        view: ' . $view . '<br>
        arguments: '; foreach($args as $arg) echo '[' . $arg . '] '; echo '<br>
    </div>
</div>
';
        }
        
        /* model */
        if(!class_exists($model) ) {
            $status = STATUS_ERR;
            return '';
        }
        
        $m = new $model();
        
        
        
        /* controler */
        if(!class_exists($controller) ) {
            $status = STATUS_ERR;
            return '';
        }
        
        $c = new $controller($m);
        $s = STATUS_ERR;
        {
            $RC = new ReflectionClass($c);
            if(!$RC->hasMethod($action) ) {
                $status = STATUS_ERR;
                return '';
            }
            $argnValid = $RC->getMethod($action)->getNumberOfRequiredParameters();
            $argnMax = $RC->getMethod($action)->getNumberOfParameters();
            $argn = is_null($args) ? 0 : count($args);
            if($argn==0 && $argnValid==0) {
                $s = $c->$action();
            } else if($argn>0 && $argn>=$argnValid && $argn<=$argnMax) {
                $s = call_user_func_array(array($c, $action), $args);
            }
            unset($RC);
        }
        
        if($s == STATUS_ERR) {
            $status = STATUS_ERR;
            return '';
        }
        
        
        
        /* view */
        if(!class_exists($view) ) {
            $status = STATUS_ERR;
            return '';
        }
        
        $v = new $view($m);
        $data = $v->output();
        
        unset($v);
        unset($c);
        unset($m);
        
        return $data;
    }
}

?>