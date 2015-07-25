<?php

Router::set_route('', 'homepage', 'index');
Router::set_route('index/', 'homepage', 'index');
Router::set_route('home/page', 'homepage', 'index');
Router::set_route('about', 'homepage', 'about');
Router::set_route('contact/', 'homepage', 'contact');

Router::set_route('story/view', 'storypage', 'view');

Router::set_route('author/', 'authorpage', 'index');


?>