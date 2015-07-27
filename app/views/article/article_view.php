<?php

class Article_view {
    private $model;
    private $template;
    
    public function __construct(iListable $model, Template $template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function output() {
        $data = $this->model->get_records();
        $this->template->set_data($data);
        return $this->template->output();
    }
}

?>