<?php

class Webpage_controller {
    private $model;
    private $template;
    private $view;
    
    public function add_css() {
        
    }
    
    public function add_js() {
        
    }
    
    public function add_data($key, $val) {
        if($this->model) {
            $this->model->add_data($key, $val);
        }
    }
    
    public function set_template($tpl_name) {
        $this->model = new Webpage_model();
        $this->template = new Template($tpl_name);
        $this->view = new Webpage_view($this->model, $this->template);
    }
    
    protected function show_webpage($template, $content) {
        $page_ctrl = new Webpage_controller($page_mdl);
        $page_ctrl->add_data('content', $content);
        
        $page_tpl = new Template('page');
        $page_view = new Webpage_view($page_mdl, $page_tpl);
        echo $this->view->show();
    }
}

?>