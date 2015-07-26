<?php

/* declare standard paths */
define('ROOT_FW_CONFIG', ROOT_FW.'/config');
define('ROOT_FW_LIB', ROOT_FW.'/library');

define('ROOT_CONTROLLERS', ROOT_APP.'/controllers');
define('ROOT_MODELS', ROOT_APP.'/models');
define('ROOT_VIEWS', ROOT_APP.'/views');
define('ROOT_TEMPLATES', ROOT_APP.'/templates');
define('ROOT_LANGS', ROOT_APP.'/langs');
define('ROOT_MODULES', ROOT_APP.'/modules');



/* standard webpage return codes in controller */
define('STATUS_OK', 1);
define('STATUS_ERR', -1);



/* include core functionality */
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



/*** autoloader ***/
function the_autoloader($class) {
    $class = '/' . strtolower($class) . '.php';
    
    $filename = ROOT_CONTROLLERS . $class;
    if(file_exists($filename) ) { include_once($filename); return; }
    
    $filename = ROOT_MODELS . $class;
    if(file_exists($filename) ) { include_once($filename); return; }
    
    $filename = ROOT_VIEWS . $class;
    if(file_exists($filename) ) { include_once($filename); return; }
}


/*** clean POST, GET and URL ***/
function unregister_globals() {
    if(ini_get('register_globals') ) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value)
            foreach($GLOBALS[$value] as $key => $var)
                if($var === $GLOBALS[$key])
                    unset($GLOBALS[$key]);
    }
}

function strip_slashes_deep($value) {
    $value = is_array($value) ? array_map('strip_slashes_deep', $value) : stripslashes($value);
    return $value;
}
function remove_mq() {
    if(get_magic_quotes_gpc() ) {
        $_GET = strip_slashes_deep($_GET);
        $_POST = strip_slashes_deep($_POST);
        $_COOKIE = strip_slashes_deep($_COOKIE);
    }
}

?>