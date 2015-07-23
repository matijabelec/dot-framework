<?php

define('ROOT_FW_CONFIG', ROOT_FW.'/config');
define('ROOT_FW_LIB', ROOT_FW.'/library');

define('ROOT_CONTROLLERS', ROOT_APP.'/controllers');
define('ROOT_MODELS', ROOT_APP.'/models');
define('ROOT_VIEWS', ROOT_APP.'/views');
define('ROOT_TEMPLATES', ROOT_APP.'/templates');
define('ROOT_LANGS', ROOT_APP.'/langs');
define('ROOT_MODULES', ROOT_APP.'/modules');

include_once(ROOT_FW_CONFIG.'/dotfw_config.php');
include_once(ROOT_FW_LIB.'/router.php');

?>