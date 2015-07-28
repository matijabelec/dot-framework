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
     */
    private static $routes = array();
    
    /**
     * Controller name
     *
     * Can have this values: string representing name of class or null.
     *
     * @var string
     * @access private
     */
    private static $controller = null;
    
    /**
     * Action name
     *
     * Can have this values: string representing method name or null.
     *
     * @var string
     * @access private
     */
    private static $action = null;
    
    /**
     * Arguments list
     *
     * Can have this values: array of arguments or null.
     *
     * @var array
     * @access private
     */
    private static $args = null;
    
    /**
     * Private constructor because class is static
     * 
     * This private constructor prevents instantiation of this class.
     * 
     * @access private
     */
    private function __construct() {}
    
    /**
     * Checking if route is in routes list
     * 
     * This method is used to determine if route exists.
     * 
     * @param string    $arg1 an string representing route.
     * 
     * @return bool the status of route (true if found, false if not).
     * @access private
     */
    private static function checkRoute($url) {
        $url = rtrim($url, '/');
        
        $url_el = explode('/', $url);
        $url_n = count($url_el);
        
        $c = '';
        $a = '';
        switch($url_n) {
            case 0:
                break;
            
            default:
            case 2:
                $a = $url_el[1];
            case 1:
                $c = $url_el[0];
                break;
        }
        
        $found = false;
        foreach(self::$routes as $route) {
            $url2_el = explode('/', $route['url']);
            $url2_n = count($url2_el);
            
            switch($url2_n) {
                case 0: break;
                
                default:
                case 2:
                    if($c == $url2_el[0]) {
                        if($url2_el[1] != '') {
                            if($a == $url2_el[1]) {
                                $c = $route['controller'];
                                $a = $route['action'];
                                if($url_n>2) {
                                    self::$args = array();
                                    for($i=2; $i<$url_n; $i++) {
                                         self::$args[] = $url_el[$i];
                                    }
                                } else
                                    self::$args = null;
                                $found = true;
                            }
                        } else {
                            $c = $route['controller'];
                            
                            if($url_n>1) {
                                $a = $url_el[1];
                            } else {
                                $a = $route['action'];
                            }
                            
                            if($url_n>2) {
                                self::$args = array();
                                for($i=2; $i<$url_n; $i++) {
                                     self::$args[] = $url_el[$i];
                                }
                            } else
                                self::$args = null;
                            $found = true;
                        }
                    }
                    break;
                case 1:
                    if($c == $url2_el[0]) {
                        $c = $route['controller'];
                        $a = $route['action'];
                        
                        if($url_n>1) {
                            self::$args = array();
                            for($i=1; $i<$url_n; $i++) {
                                 self::$args[] = $url_el[$i];
                            }
                        } else
                            self::$args = null;
                        $found = true;
                    }
                    break;
            }
            
            if($found == true) {
                self::$controller = $c;
                self::$action = $a;
                break;
            }
        }
        
        if($found == false) {
            self::$controller = null;
            self::$action = null;
            self::$args = null;
        }
        
        return $found;
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
     * @param string    $arg2 an string representing controller name.
     * @param string    $arg3 an string representing action name if null then
     *                          action will be set to 'index'.
     * 
     * @access public
     */
    public static function addRoute($url, $controller, $action=null) {
        if(is_null($action) ) $action = 'index';
        self::$routes[] = array('url'=>$url, 'controller'=>$controller, 'action'=>$action);
    }
    
    /**
     * Used to run controller
     * 
     * This method is used to run controller depending on route. If controller not 
     * exists or route not valid then errorpage is shown.
     * 
     * @access public
     */
    public static function run() {
        if(isset($_GET[DEFAULT_URL_KEY]) ) {
            $url = $_GET[DEFAULT_URL_KEY];
            
            // check route
            if(self::checkRoute($url) == true) {
                // run controller
                $ce = explode('/', self::$controller);
                $c = ucfirst($ce[count($ce)-1].'_controller');
                $a = self::$action;
                $ar = self::$args;
                if(is_null($ar) )
                    $ar = array();
                
                if(class_exists($c) ) {
                    $obj = new $c;
                    if(method_exists($obj, $a) && is_callable(array($obj, $a) ) ) {
                        $status = STATUS_ERR;
                        
                        $ok = true;
                        if(strlen($a) >= 2 && $a[0] == '_' && $a[1] == '_')
                            $ok = false;
                        
                        if($ok) {
                            ob_start();
                            
                            $ReflectionFoo = new ReflectionClass($c);
                            $ar_valid_num = $ReflectionFoo->getMethod($a)->getNumberOfRequiredParameters();
                            $ar_max_num = $ReflectionFoo->getMethod($a)->getNumberOfParameters();
                            $ar_cnt = count($ar);
                            
                            if($ar_cnt == 0) {
                                if($ar_valid_num == 0) {
                                    $status = $obj->$a();
                                }
                            } else if($ar_cnt>=$ar_valid_num && $ar_cnt<=$ar_max_num)
                                $status = call_user_func_array(array($obj, $a), $ar);
                            
                            $preview = ob_get_contents();
                            ob_end_clean();
                        }
                        
                        if(!isset($status) || $status != STATUS_ERR) {
                            echo $preview;
                            return;
                        }
                    }
                }
            }
        }
        
        // route error (404: NOT FOUND)
        echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Error 404</title>
</head>
<body>
    <h1>Error 404</h1>
    <p>Page not found.</p>
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public static function run2() {
        if(isset($_GET[DEFAULT_URL_KEY]) ) {
            $url = $_GET[DEFAULT_URL_KEY];
            
            $frontController = new FrontController;
            $frontController->index($url);
        } else {
            echo '<h1>Ooops... Error!</h1><p>Something went wrong.</p>';
        }
    }
}

?>