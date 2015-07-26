<?php

/*** declare ROOT directories ***/
define('ROOT', __DIR__);
define('ROOT_FW', ROOT.'/fw');
define('ROOT_APP', ROOT.'/app');


/*** load Dot framework ***/
include_once(ROOT_FW.'/belfw.php');


/*** include routes ***/
include_once(ROOT_APP.'/routes.php');

/*** init ***/
spl_autoload_register('the_autoloader');
remove_mq();
unregister_globals();

Router::run();

?>