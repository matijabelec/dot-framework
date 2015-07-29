<?php

Session::start();

/*
 * routes
 */
Router::addRoute('', 'homepage', 'webpage', 'webpage', 'index');
Router::addRoute('index', 'webpage', 'webpage', 'webpage', 'index');

Router::addRoute('article/', 'article', 'article', 'article', 'random');
Router::addRoute('articles/page', 'article', 'articlespage', 'articles', 'page');


/*
 * other includes
 */
include_once(ROOT_APP.'/includes/interfaces.php');

?>