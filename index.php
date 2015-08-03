<?php

/**
 * Index.php file (aka main file) in Dot-framework
 * 
 * PHP version 5
 * 
 * LICENSE: 
 *
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */

/**
 * Used to identify path to root directory
 * @var string representing a root of framework
 */
define('ROOT', __DIR__ . '/');


/*
 * Load config files.
 */
require_once(ROOT . 'fw/config/environment.php');
require_once(ROOT . 'fw/config/db.php');
require_once(ROOT . 'fw/config/directories.php');


/*
 * Prepare error_reporting.
 */
if(ENVIRONMENT == 'DEV') {
    error_reporting(E_ALL | E_STRICT);
    ini_set("display_errors", 1);
} else if(ENVIRONMENT == 'PROD') {
    error_reporting(E_ALL & ~E_DEPRECATED);
    ini_set("display_errors", 0);
} else {
    
    /*
     * Stop loading of framework if status of ENVIRONMENT is not known.
     */
    die('ENVIRONMENT has wrong value!');
}


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Load library files.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
require_once(ROOT . 'fw/library/registry.php');
require_once(ROOT . 'fw/library/load.php');

require_once(ROOT . 'fw/library/request/request.php');
require_once(ROOT . 'fw/library/request/cookie.php');
require_once(ROOT . 'fw/library/request/session.php');

require_once(ROOT . 'fw/library/database/databasepdoconnection.php');
require_once(ROOT . 'fw/library/database/database.php');

require_once(ROOT . 'fw/library/multilanguage/multilangfile.php');

require_once(ROOT . 'fw/library/mvc/template.php');
require_once(ROOT . 'fw/library/mvc/model.php');
require_once(ROOT . 'fw/library/mvc/view.php');
require_once(ROOT . 'fw/library/mvc/controller.php');

require_once(ROOT . 'fw/library/router.php');

require_once(ROOT_APP . 'includes.php');


/*
 * Start working with sessions. Session is required for framework to operate normal with authorizations.
 */
Session::start(DEFAULT_SESSION_NAME);


/*
 * Get/set default language for multilanguage mode.
 */
if(MULTILANG == true) {
    
    /*
     * Check if language cookie is not set yet.
     */
    if(is_null(Cookie::getInstance()->get(DEFAULT_LANG_COOKIE_NAME) ) ) {
        
        /* 
         * If it is not set, then set new language cookie with DEFAULT_LANGUAGE.
         */
        Cookie::getInstance()->set(DEFAULT_LANG_COOKIE_NAME, DEFAULT_LANGUAGE, Cookie::TIME_MONTH, '/');
    }
    
    /*
     * Main registry will always set variable 'language' to current language (this is like global variable 
     * and can be used in any controller, view, model, etc.).
     */
    Registry::getInstance()->language = Cookie::getInstance()->get(DEFAULT_LANG_COOKIE_NAME);
}


/*
 * Start router and check request.
 * If any exception occured print it here.
 */
try {
    
    /*
     * Try to find controller for current request.
     */
    Router::route(new Request);
} catch(Exception $e) {
    
    /*
     * Show error page on exception.
     */
    echo "<!doctype html><html><head><meta charset=\"UTF-8\"><title>Generic errorpage</title></head><body><style>*{margin:0;padding:0;}body{text-align:center;border:1px solid #000;margin:2em 1em;}h1,h2,p{display:block;box-sizing:border-box;position:relative;}h1{font-size:22pt;margin:1em .4em .4em;padding:.4em .2em;border-bottom:1px solid #000;}h2{font-size:20pt;margin:.6em .4em .2em;padding:.4em .2em;}p{text-align:left;font-size:16pt;margin:.4em .4em 1em;padding:.4em .2em;}.colored{color: #cc4444;}</style><div><h1>Dot framework</h1><h2>Generic errorpage</h2><p class=\"colored\">Error:</p><p>{$e->getMessage()}</p></div></body></html>";
}

?>