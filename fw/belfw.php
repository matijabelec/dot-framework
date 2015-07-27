<?php

/**
 * Main init file for Dot-framework
 *
 * File includes all core functionaly of framework. It is
 * main point of init file of framework.
 *
 * PHP version 5
 *
 * LICENSE: 
 *
 * @author     Matija Belec <matijabelec1@gmail.com>
 * @copyright  2015 Matija Belec
 * @license    Proprietary
 */

/*
 * declare standard paths
 */

/**
 * Standard path for fw/config
 */
define('ROOT_FW_CONFIG', ROOT_FW.'/config');

/**
 * Standard path for fw/lib
 */
define('ROOT_FW_LIB', ROOT_FW.'/library');


/**
 * Controller's methods return this if they succeed
 */
define('STATUS_OK', 1);

/**
 * Controller's methods return this if they NOT succeed
 */
define('STATUS_ERR', -1);



/*
 * include all core functionality of dot-framework
 */
include_once(ROOT_FW_CONFIG.'/dotfw_config.php');
include_once(ROOT_APP.'/config.php');

include_once(ROOT_FW_LIB.'/loader.php');
include_once(ROOT_FW_LIB.'/url.php');
include_once(ROOT_FW_LIB.'/router.php');
include_once(ROOT_FW_LIB.'/session.php');

include_once(ROOT_FW_LIB.'/interfaces.php');

include_once(ROOT_FW_LIB.'/database.php');
include_once(ROOT_FW_LIB.'/template.php');

include_once(ROOT_FW_LIB.'/model.php');
include_once(ROOT_FW_LIB.'/view.php');
include_once(ROOT_FW_LIB.'/controller.php');


/**
 * Autoloader function for classes
 * 
 * Autoloader function is capable of loading controller class, 
 * model class or view class from ROOT_CONTROLLERS or ROOT_MODELS 
 * or ROOT_VIEWS directory.
 * 
 * @param string $arg1 a class name
 */
function the_autoloader($class) {
    $class = '/' . strtolower($class) . '.php';
    
    $filename = ROOT_CONTROLLERS . $class;
    if(file_exists($filename) ) { include_once($filename); return; }
    
    $filename = ROOT_MODELS . $class;
    if(file_exists($filename) ) { include_once($filename); return; }
    
    $filename = ROOT_VIEWS . $class;
    if(file_exists($filename) ) { include_once($filename); return; }
}

/**
 * Used for unregister globals
 * 
 * This function traverse all globals and unset their values
 */
function unregister_globals() {
    if(ini_get('register_globals') ) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value)
            foreach($GLOBALS[$value] as $key => $var)
                if($var === $GLOBALS[$key])
                    unset($GLOBALS[$key]);
    }
}

/**
 * Function used to strip slashes in all $value values
 * 
 * If $value is array then function is called on any value in
 * that array.
 * 
 * @param mixed $arg1 an value (string or array)
 * 
 * @return mixed returned cleaned value
 */
function strip_slashes_deep($value) {
    $value = is_array($value) ? array_map('strip_slashes_deep', $value) : stripslashes($value);
    return $value;
}

/**
 * Function used to remove 'magic quotes'
 * 
 * Function removes 'magic quotes' in all $_GET,
 * $_POST or $_COOKIE data.
 */
function remove_mq() {
    if(get_magic_quotes_gpc() ) {
        $_GET = strip_slashes_deep($_GET);
        $_POST = strip_slashes_deep($_POST);
        $_COOKIE = strip_slashes_deep($_COOKIE);
    }
}

?>