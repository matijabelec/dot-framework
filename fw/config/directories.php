<?php

/**
 * Directories paths configuration file
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
 * Website root path (public_html)
 * @var string represents a path to "site root"
 */
define('WEB_ROOT', '/dot-framework/');



/**
 * Application root path (where are models, view, controllers etc.)
 * @var string represents path
 */
define('ROOT_APP', ROOT . 'app/');

/**
 * Models root path
 * @var string represents path
 */
define('APP_MODELS', ROOT_APP . 'models/');

/**
 * Views root path
 * @var string represents path
 */
define('APP_VIEWS', ROOT_APP . 'views/');


/**
 * Controllers root path
 * @var string represents path
 */
define('APP_CONTROLLERS', ROOT_APP . 'controllers/');

/**
 * Templates root path
 * @var string represents path
 */
define('APP_TEMPLATES', ROOT_APP . 'templates/');

?>