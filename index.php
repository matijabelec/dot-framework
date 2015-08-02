<?php

define('ROOT', __DIR__ . '/');

/*
 * Load config files
 */
require_once(ROOT . 'fw/config/environment.php');
require_once(ROOT . 'fw/config/db.php');
require_once(ROOT . 'fw/config/directories.php');

/*
 * Load library files.
 */
require_once(ROOT . 'fw/library/registry.php');
require_once(ROOT . 'fw/library/load.php');

require_once(ROOT . 'fw/library/request/request.php');
require_once(ROOT . 'fw/library/request/cookie.php');
require_once(ROOT . 'fw/library/request/session.php');

require_once(ROOT . 'fw/library/database/databasepdoconnection.php');
require_once(ROOT . 'fw/library/database/database.php');

require_once(ROOT . 'fw/library/mvc/template.php');
require_once(ROOT . 'fw/library/mvc/model.php');
require_once(ROOT . 'fw/library/mvc/controller.php');
require_once(ROOT . 'fw/library/mvc/view.php');

require_once(ROOT . 'fw/library/router.php');

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
 * Start working with sessions. Session is required
 * for framework to operate normal with authorizations.
 */
Session::start(DEFAULT_SESSION_NAME);

/*
 * Start router and check request.
 * If any exception occured print it here.
 */
try {
    Router::route(new Request);
} catch(Exception $e) {
    echo "<!doctype html><html><head><meta charset=\"UTF-8\"><title>Generic errorpage</title></head><body><style>*{margin:0;padding:0;}body{text-align:center;border:1px solid #000;margin:2em 1em;}h1,h2,p{display:block;box-sizing:border-box;position:relative;}h1{font-size:22pt;margin:1em .4em .4em;padding:.4em .2em;border-bottom:1px solid #000;}h2{font-size:20pt;margin:.6em .4em .2em;padding:.4em .2em;}p{text-align:left;font-size:16pt;margin:.4em .4em 1em;padding:.4em .2em;}.colored{color: #cc4444;}</style><div><h1>Dot framework</h1><h2>Generic errorpage</h2><p class=\"colored\">Error:</p><p>{$e->getMessage()}</p></div></body></html>";
}

?>