<?php

class WebpageView {
    protected $model;
    protected $template;
    
    public function __construct(WebpageModel $model, Template $template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function output() {
        $data = $this->model->getData();
        $this->template->setData($data);
        return $this->template->output(true);
    }
}

?>