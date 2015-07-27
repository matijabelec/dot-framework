<?php

class Navigation_controller {
    private $model;
    private $view;
    private $lang;
    
    public function __construct($lang) {
        $this->model = new Region_model('region/nav', $lang);
        $template = new Template('nav');
        
        $this->model->set('nav-lang-retlink', '/');
        
        $this->view = new Region_view($this->model, $template);
        $this->lang = $lang;
    }
    
    public function output() {
        return $this->view->output();
    }
}

?>