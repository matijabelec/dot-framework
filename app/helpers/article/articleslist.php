<?php

class ArticlesList {
    private $model;
    private $view;
    private $controller;
    
    public function __construct() {
        $this->model = null;
        $this->controller = null;
        $this->view = null;
    }
    
    public function render() {
        return '
<p>List test: </p>
<ul>
    <li>one</li>
    <li>two</li>
</ul>';
        //return $this->view->output();
    }
}

?>