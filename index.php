<?php

define('ROOT', __DIR__);
define('ROOT_FW', ROOT.'/fw');
define('ROOT_APP', ROOT.'/app');

include_once(ROOT_FW.'/belfw.php');
echo ROOT_FW;

include_once(ROOT_APP.'/config.php');
include_once(ROOT_APP.'/routes.php');
Router::run();

?>