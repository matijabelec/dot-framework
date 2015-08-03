<?php

/**
 * Main configuration file
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
 * Set production or development environment
 * @var string 'DEV'|'PROD' represents what type of environement is currently active
 */
define('ENVIRONMENT', 'DEV');


/**
 * Used in Router::route to remove first N parameters. If set to 1 then first parameter is omited from uri 
 * (useful if script is not in root directory (usualy public_html) of web server).
 * @var integer in range 0-N, represent index of first parameter
 */
define('REQUEST_FIRST_PARAM', 1);


/**
 * Default session's name.
 * @var string representing session name
 */
define('DEFAULT_SESSION_NAME', 'SESS_DFW_UNK');




/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Language data
 * 
 * Primarily language cookie config's.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

/**
 * Used if website provides content in more than one language. It sets new language cookie (defined by data 
 * lower in this section).
 * @var boolean represents if multilang is used (true) or it is not used (false)
 */
define('MULTILANG', true);

/**
 * Used in MultilangBaseController as default language to set in cookie if no language cookie found.
 * @var string represents short language code
 */
define('DEFAULT_LANGUAGE', 'en');

/**
 * Used as language cookie name.
 * @var string represents cookie name
 */
define('DEFAULT_LANG_COOKIE_NAME', 'lang');

?>