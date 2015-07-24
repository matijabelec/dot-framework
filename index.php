<?php

/* declare ROOT directories */
define('ROOT', __DIR__);
define('ROOT_FW', ROOT.'/fw');
define('ROOT_APP', ROOT.'/app');

/* load Dot framework */
include_once(ROOT_FW.'/belfw.php');


/* run app */
include_once(ROOT_APP.'/routes.php');
Router::run();

?>