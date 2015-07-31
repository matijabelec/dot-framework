<?php

/**
 * Cookie class used for operations with cookies in Dot-framework
 *
 * Cookie class used for operation with cookies in framework.
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
 * Cookie class
 * 
 * It can create cookie with method set() or return value of an 
 * cookie with method get().
 */
class Cookie {
    /**
     * Private constructor because class is static
     * 
     * This private constructor prevents instantiation of this class.
     * 
     * @access private
     */
    private function __construct() {}
    
    /**
     * Sets a cookie
     * 
     * This method can set cookie with parameters.
     * 
     * @param string    $arg1 an string representing name of cookie.
     * @param string    $arg2 an string representing value.
     * @param int    $arg3 an integer representing expiration of cookie
     *                      in seconds from now (time() is automatically
     *                      added to argument's value).
     * @param string    $arg4 an string representing path.
     * @param string    $arg5 an string representing domain.
     * @param bool    $arg6 an boolean value representing secure value of cookie.
     * @param bool    $arg7 an boolean value representing http/https (false/true).
     * 
     * @access public
     * @static
     */
    public static function set($name, 
                               $value = '', 
                               $expire = 86400, 
                               $path = '/', 
                               $domain = null, 
                               $secure = false, 
                               $httponly = false) {
        if(isset($name) ) {
            if(isset($domain) && !is_null($domain) )
                setcookie($name, $value, time()+$expire, $path, $domain, $secure, $httponly);
            else
                setcookie($name, $value, time()+$expire, $path);
        }
    }
    
    /**
     * Return data from cookie
     * 
     * Returns data for given cookie.
     * 
     * @param string    $arg1 an string representing cookie's name.
     * 
     * @return mixed the data of cookie or NULL if cookie not set.
     * @access public
     * @static
     */
    public static function get($name) {
        if(isset($_COOKIE[$name]) )
            return $_COOKIE[$name];
        return null;
    }
}

?>