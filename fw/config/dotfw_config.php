<?php

/**
 * Main config file for Dot-framework
 *
 * File sets standard config data of framework.
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
 * Standard path for app/controllers
 */
define('ROOT_CONTROLLERS', ROOT_APP.'/controllers');

/**
 * Standard path for app/models
 */
define('ROOT_MODELS', ROOT_APP.'/models');

/**
 * Standard path for app/views
 */
define('ROOT_VIEWS', ROOT_APP.'/views');

/**
 * Standard path for app/helpers
 */
define('ROOT_HELPERS', ROOT_APP.'/helpers');

/**
 * Standard path for app/templates
 */
define('ROOT_TEMPLATES', ROOT_APP.'/templates');

/**
 * Standard path for app/langs
 */
define('ROOT_LANGS', ROOT_APP.'/langs');

/**
 * Standard path for app/modules
 */
define('ROOT_MODULES', ROOT_APP.'/modules');

/**
 * Global variable used when it is needed to return null by reference
 * @global null $GLOBALS['nullGuard']
 */
$nullGuard = null;

/**
 * Global variable used for autoload function to determine paths
 * @global array $GLOBALS['includePaths']
 */
$includePaths = [];

?>