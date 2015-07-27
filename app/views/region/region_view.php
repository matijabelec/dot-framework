<?php

class Region_view {
    private $model;
    private $template;
    
    public function __construct(Model $model, Template $template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function output() {
        $data = $this->model->get_lang_data();
        $this->template->set_data($data);
        return $this->template->output();
    }
}

?>