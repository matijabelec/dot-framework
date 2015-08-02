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

?>