<?php

define('WEB_ROOT', '/dot-framework');
define('WEB_SITE', WEB_ROOT . '/site');

define('SITE_CSS', WEB_SITE.'/css');
define('SITE_JS', WEB_SITE.'/js');
define('SITE_GFX', WEB_SITE.'/gfx');

/*** database ***/
define('DFW_DB_DATABASE', 'recenicadvije');
define('DFW_DB_HOSTNAME', 'localhost');
define('DFW_DB_USERNAME', 'root');
define('DFW_DB_PASSWORD', 'belec');

error_reporting(E_ALL);
ini_set("display_errors", 1);

?>