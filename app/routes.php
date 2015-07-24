<?php

Router::set_route('', 'homepage', 'index');
Router::set_route('index', 'page/homepage', 'index');
Router::set_route('about', 'homepage', 'about');
Router::set_route('contact/', 'page/homepage', 'contact');

Router::set_route('story/view', 'page/homepage', 'contact');

Router::set_route('author/', 'authorpage', 'index');


?>