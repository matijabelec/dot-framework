<?php

Router::set_route('', 'webpage', 'home');
Router::set_route('index', 'webpage', 'home');
Router::set_route('about', 'webpage', 'about');
Router::set_route('contact', 'webpage', 'contact');

Router::set_route('story/view', 'webpage', 'contact');

Router::set_route('author/', 'authorpage', 'index');


?>