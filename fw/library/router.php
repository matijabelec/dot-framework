<?php

class Router {
    protected static $routes = array();
    
    protected static $controller = null;
    protected static $action = null;
    protected static $args = null;
    
    protected static function check_route($url) {
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
    
    public static function set_route($url, $controller, $action=null) {
        if(is_null($action) ) $action = 'index';
        self::$routes[] = array('url'=>$url, 'controller'=>$controller, 'action'=>$action);
    }
    
    public static function run() {
        $url = $_GET['url'];
        
        if(self::check_route($url) == true) {
            echo '<br>found<br>';
            echo self::$controller . '->' . self::$action;
            if(!is_null(self::$args) ) {
                echo '(';
                foreach(self::$args as $arg) {
                    echo ' ' . $arg;
                }
                echo ' )';
            }
            
            return;
        }
        
        // route error
        echo '<br>error<br>';
    }
}

?>