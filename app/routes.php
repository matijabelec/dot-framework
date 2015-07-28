<?php

Session::start();

Router::addRoute('', 'homepage', 'index');
Router::addRoute('index', 'homepage', 'index');

Router::addRoute('story/page', 'storypage', 'page');
Router::addRoute('story/view', 'storypage', 'view');
Router::addRoute('story', 'storypage', 'index');

Router::addRoute('test/', 'testpage', 'index');

Router::addRoute('lang', 'lang', 'set');

?>