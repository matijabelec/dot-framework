<?php

class Webpage_view {
    private $model;
    private $template;
    
    public function __construct(iWebpage $model, Template $template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function output() {
        $data = $this->model->get_data();
        $this->template->set_data($data);
        
        return $this->template->output(true, true);
    }
}

?>