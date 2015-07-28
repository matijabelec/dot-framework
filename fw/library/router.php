<?php

/**
 * Router class used for routing in Dot-framework
 *
 * Router class used for routing in framework.
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
 * Route class used for construction of route data in Dot-framework
 * 
 * Used to transport data about route.
 */
class Route {
    /**
     * Route name
     *
     * Can have this values: string representing route or null.
     *
     * @var string
     * @access private
     */
    private $route = null;
    
    /**
     * model name
     *
     * Can have this values: string representing name or null.
     *
     * @var string
     * @access private
     */
    private $model = null;
    
    /**
     * view name
     *
     * Can have this values: string or null.
     *
     * @var string
     * @access private
     */
    private $view = null;
    
    /**
     * controller name
     *
     * Can have this values: string or null.
     *
     * @var string
     * @access private
     */
    private $controller = null;
    
    /**
     * action name
     *
     * Can have this values: string or null.
     *
     * @var string
     * @access private
     */
    private $action = null;
    
    /**
     * list of arguments
     *
     * Can have this values: array of arguments or null.
     *
     * @var array
     * @access private
     */
    private $arguments = null;
    
    /**
     * Constructor for route
     * 
     * It sets all route data.
     * 
     * @param string    $arg1 an string representing route.
     * @param string    $arg2 an string representing model name.
     * @param string    $arg3 an string representing view name.
     * @param string    $arg4 an string representing controller name.
     * @param string    $arg5 an string representing action name.
     * @param array    $arg6 an array representing arguments array.
     * 
     * @access public
     */
    public function __construct($route, $model, $view, $controller, $action, $arguments) {
        if(isset($route) 
        && isset($model) 
        && isset($view) 
        && isset($controller) 
        && isset($action) 
        && isset($arguments) ) {
            $this->route = $route;
            $this->model = $model . '_model';
            $this->view = $view . '_view';
            $this->controller = $controller . '_controller';
            $this->action = $action;
            $this->arguments = $arguments;
        }
    }
    
    /**
     * Get route
     * 
     * This method is used to get route.
     * 
     * @return string
     * @access public
     */
    public function getRoute() {
        return $this->route;
    }
    
    /**
     * Get model name
     * 
     * This method is used to get model name.
     * 
     * @return string
     * @access public
     */
    public function getModel() {
        return $this->model;
    }
    
    /**
     * Get view name
     * 
     * This method is used to get view name.
     * 
     * @return string
     * @access public
     */
    public function getView() {
        return $this->view;
    }
    
    /**
     * Get controller name
     * 
     * This method is used to get controller name.
     * 
     * @return string
     * @access public
     */
    public function getController() {
        return $this->controller;
    }
    
    /**
     * Get action name
     * 
     * This method is used to get action name.
     * 
     * @return string
     * @access public
     */
    public function getAction() {
        return $this->action;
    }
    
    /**
     * Get array of arguments
     * 
     * This method is used to get array of arguments.
     * 
     * @return array
     * @access public
     */
    public function getArguments() {
        return $this->arguments;
    }
}

/**
 * Router class used for routing in Dot-framework
 * 
 * Used to start a controller based on route (url) provided. It 
 * has method for redirect (method redirect() ).
 */
class Router {
    /**
     * Routes list
     *
     * In this list all routes is stored. Router can route any of
     * this routes or if route not found - shows errorpage.
     *
     * @var array
     * @access private
     * @static
     */
    private static $routes = array();
    
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
     * Checking if route is in routes list
     * 
     * This method is used to determine if route exists.
     * 
     * @param string    $arg1 an string representing route.
     * 
     * @return Route
     * @access public
     * @static
     */
    public static function getRoute($route) {
        $route = rtrim($route, '/');
        $rEl = ($route == '' ? array('') : explode('/', $route) );
        $rN = count($rEl);
        
        $args = array();
        switch($rN) {
            case 2:
            case 1:
            case 0:
                break;
            default:
                for($i=2; $i<$rN; $i++)
                    $args[] = $rEl[$i];
                break;
        }
        
        foreach(self::$routes as $r) {
            $roEl = explode('/', $r['url']);
            $roN = count($roEl);
            
            if($roN==1 && $rN==1) {
                if($roEl[0] == $rEl[0]) {
                    return new Route($r['url'], 
                                     $r['model'], 
                                     $r['view'], 
                                     $r['controller'], 
                                     $r['action'], 
                                     $args);
                }
            } else if($roN==2 && $roEl[1]=='' && $rN>=1) {
                if($roEl[0] == $rEl[0]) {
                    return new Route($r['url'], 
                                     $r['model'], 
                                     $r['view'], 
                                     $r['controller'], 
                                     $rN==1 ? $r['action'] : $rEl[1], 
                                     $args);
                }
            } else if($roN==2 && $roEl[1]!='' && $rN>=2) {
                if($roEl[0]==$rEl[0] && roEl[1]==$r[1]) {
                    return new Route($r['url'], 
                                     $r['model'], 
                                     $r['view'], 
                                     $r['controller'], 
                                     $r['action'], 
                                     $args);
                }
            }
        }
        return null;
    }
    
    /**
     * Used to set a new route
     * 
     * This method is used to set new route. Route url can be any of this:
     *   1) 'controller' - set new controller and action 
     *   2) 'controller/' - set new controller and default action (action can be 
     *                      overriden)
     *   3) 'controller/action' - set new controller and action
     * 
     * @param string    $arg1 an string representing route.
     * @param string    $arg2 an string representing model name.
     * @param string    $arg3 an string representing view name or null
     * @param string    $arg4 an string representing controller name or null
     * @param string    $arg5 an string representing action name or null.
     * 
     * @access public
     * @static
     */
    public static function addRoute($url, $model, $view, $controller=null, $action=null) {
        if(isset($url) 
        && isset($model) 
        && isset($view) 
        && isset($controller) 
        && isset($action) ) {
            self::$routes[] = array( 
                'url' => $url, 
                'model' => $model, 
                'view' => $view, 
                'controller' => $controller, 
                'action' => $action);
        }
    }
    
    /**
     * Used to run controller
     * 
     * This method is used to run controller depending on route. If controller not 
     * exists or route not valid then errorpage is shown.
     * 
     * @access public
     * @static
     */
    public static function run() {
        if(isset($_GET[DEFAULT_URL_KEY]) ) {
            $url = $_GET[DEFAULT_URL_KEY];
            
            $page = FrontController::index($url, $status);
            if($status == STATUS_OK) {
                echo $page;
                return;
            }
        }
        echo '<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Error</title>
</head>
<body>
    <h1>Ooops... Error!</h1>
    <p>Something went wrong.</p>
    <p>Go back to <a href="' . WEB_ROOT . '">home page</a>.</p>
</body>
</html>';
    }
    
    /**
     * Used to redirect webpage
     * 
     * This method is used to redirect page to new page. It sets header() or, if 
     * falied, it sets 'script' tag for javascript window.location redirection.
     * 
     * @param string    $arg1 an string representing route.
     * @param bool    $arg2 if true $url is parsed as relative to WEB_ROOT.
     * 
     * @access public
     * @static
     */
    public static function redirect($url, $relative=true) {
        if($relative)
            $url = WEB_ROOT . $url;
        
        if(headers_sent() ) {
            die('<script type="text/javascript">window.location=\'' . $url . '\';</script>');
        } else {
            header('Location: ' . $url);
            die();
        }
    }
}

?>