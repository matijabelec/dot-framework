<?php

Session::start();

/*
 * routes
 */
//Router::addRoute('', 'homepage', 'homepage', 'webpage', 'index');
//Router::addRoute('index', 'homepage', 'homepage', 'webpage', 'index');

//Router::addRoute('article/', 'article', 'article', 'article', 'random');
//Router::addRoute('articles/page', 'article', 'articles', 'articles', 'page');

//Router::addRoute('', 'homepage', 'homepage', 'webpage', 'index');
//Router::addRoute('articles/page', 'articlespage', 'articlespage', 'articlespage', 'page');
//Router::addRoute('articles', 'articlespage', 'articlespage', 'articlespage', 'index');

Router::addRoute('', 'article', 'articleslist', 'Webpage', 'index');
Router::addRoute('articles/page', 'article', 'articlespage', 'articles', 'page');

Router::addRoute('nav', 'navigation', 'navigation', 'test', 'index');
Router::addRoute('test', 'complex', 'homepage', 'test', 'index');

/*
 * other includes
 */
include_once(ROOT_APP.'/includes/interfaces.php');

?>