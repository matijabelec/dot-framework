<?php

class Article_controller {
    private $model;
    private $view;
    
    public function __construct() {
        $template = new Template('region');
        
        $template = new Template('article/article-show');
        
        $this->model = new Article_model;
        $this->view = new Article_view($this->model, $template);
    }
    
    public function set_criteria($id) {
        $this->model->set_id($id);
    }
    
    public function output() {
        return $this->view->output();
    }
}

?>