<?php

/**
 * Set production or development environment
 * 
 * @var [DEV|PROD]
 */
define('ENVIRONMENT', 'DEV');

/**
 * Used in Router::route to remove first N parameters.
 * If set to 1 then first parameter is omited from uri
 * (useful if script is not in root directory (usualy
 * public_html) of web server).
 * 
 * @var integer in range 0-N
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
 * Used in MultilangBaseController as default language
 * to set in cookie if no language cookie found.
 */
define('DEFAULT_LANGUAGE', 'en');

/**
 * Used as language cookie name.
 */
define('DEFAULT_LANG_COOKIE_NAME', 'lang');

?>