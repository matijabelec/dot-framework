<?php

/**
 * Set production or development environment
 * 
 * @var [DEV|PROD]
 */
define('ENVIRONMENT', 'DEV');

/*
 * Database connection data
 */
define('DB_HOSTNAME', 'localhost');
define('DB_DATABASE', 'recenicadvije');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'belec');

/**
 * Used in Router::route to remove first N parameters.
 * If set to 1 then first parameter is omited from uri
 * (useful if script is not in root directory (usualy
 * public_html) of web server).
 * 
 * @var integer in range 0-N
 */
define('REQUEST_FIRST_PARAM', 1);

/* 
 * declare directories 
 */
define('ROOT', __DIR__ . '/');
define('ROOT_FW', ROOT . 'fw/');
define('ROOT_APP', ROOT . 'app/');
define('FW_LIBRARY', ROOT_FW . 'library/');
define('APP_MODELS', ROOT_APP . 'models/');
define('APP_VIEWS', ROOT_APP . 'views/');
define('APP_CONTROLLERS', ROOT_APP . 'controllers/');
define('APP_TEMPLATES', ROOT_APP . 'templates/');

/*
 * Load all library files.
 */
require_once(FW_LIBRARY . 'registry.php');
require_once(FW_LIBRARY . 'request.php');
require_once(FW_LIBRARY . 'router.php');
require_once(FW_LIBRARY . 'load.php');
require_once(FW_LIBRARY . 'database.php');
require_once(FW_LIBRARY . 'template.php');
require_once(FW_LIBRARY . 'model.php');
require_once(FW_LIBRARY . 'controller.php');
require_once(FW_LIBRARY . 'view.php');
require_once(ROOT_APP . 'includes.php');

/*
 * prepare error_reporting
 */
if(ENVIRONMENT == 'DEV') {
    error_reporting(E_ALL | E_STRICT);
    ini_set("display_errors", 1);
} else if(ENVIRONMENT == 'PROD') {
    error_reporting(E_ALL & ~E_DEPRECATED);
    ini_set("display_errors", 0);
} else {
    die('ENVIRONMENT has wrong value!');
}

/*
 * Start router and check request.
 * If any exception occured print it here.
 */
try {
    Router::route(new Request);
} catch(Exception $e) {
    echo '<pre>' . print_r($e->getMessage(), 1) . '</pre>';
}

?>