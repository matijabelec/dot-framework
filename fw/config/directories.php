<?php

/**
 * Directories paths configuration file in Dot-framework
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
 * Application root path (where are models, view, controllers etc.)
 * 
 * @var string represents path
 */
define('ROOT_APP', ROOT . 'app/');

define('APP_MODELS', ROOT_APP . 'models/');
define('APP_VIEWS', ROOT_APP . 'views/');
define('APP_CONTROLLERS', ROOT_APP . 'controllers/');
define('APP_TEMPLATES', ROOT_APP . 'templates/');
define('APP_MULTILANGS', ROOT_APP . 'multilangs/');


/**
 * Website root path (public_html)
 * 
 * @var string represents a path to "site root"
 */
define('WEB_ROOT', '/dot-framework/');

?>