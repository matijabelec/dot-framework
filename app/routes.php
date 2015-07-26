<?php

Router::set_route('', 'homepage', 'index');
Router::set_route('index', 'homepage', 'index');

Router::set_route('story/page', 'storypage', 'page');
Router::set_route('story/view', 'storypage', 'view');
Router::set_route('story', 'storypage', 'index');

Router::set_route('test/', 'testpage', 'index');

?>