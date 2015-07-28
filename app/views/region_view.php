<?php

class Region_view {
    private $model;
    private $template;
    
    public function __construct(Region_model $model, Template $template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function output() {
        $data = $this->model->getData();
        if(!is_null($data) )
            $this->template->setData($data);
        return $this->template->output();
    }
}

?>