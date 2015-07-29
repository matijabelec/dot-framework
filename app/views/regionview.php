<?php

class RegionView {
    private $model;
    private $template;
    
    public function __construct(RegionModel $model, Template $template) {
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