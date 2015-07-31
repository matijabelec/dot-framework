<?php

/**
 * Session class used for operations with session in Dot-framework
 *
 * Session class used for operation with session in framework.
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
 * Session class
 * 
 * It can start session with name and destroy session. Sessions variables 
 * can be accessed with methods get and set.
 */
class Session {
    /**
     * Private constructor because class is static
     * 
     * This private constructor prevents instantiation of this class.
     * 
     * @access private
     */
    private function __construct() {}
    
    /**
     * Starting work with session
     * 
     * This method can set name for session which is then started.
     * 
     * @param string    $arg1 an string representing name for session.
     * 
     * @access public
     * @static
     */
    public static function start($name='SESS_DFW_UNK') {
        session_name($name);
        session_start();
    }
    
    /**
     * Used to destroy an session
     * 
     * This method destroys the session.
     * 
     * @access public
     * @static
     */
    public static function destroy() {
        session_destroy();
    }
    
    /**
     * Set data in session variable
     * 
     * Sets data for given variable in session.
     * 
     * @param string    $arg1 an string representing variable's name.
     * @param mixed    $arg2 represents variable's value.
     * 
     * @access public
     * @static
     */
    public static function set($key, $val) {
        if(isset($key) && isset($val) )
            $_SESSION[$key] = $val;
    }
    
    /**
     * Return data from session
     * 
     * Returns data for given key.
     * 
     * @param string    $arg1 an string representing variable's name.
     * 
     * @return mixed the data of variable.
     * @access public
     * @static
     */
    public static function get($key) {
        if(isset($key) && isset($_SESSION[$key]) )
            return $_SESSION[$key];
        return null;
    }
}

?>