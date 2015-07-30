<?php

class WebpageView {
    protected $model;
    protected $template;
    
    public function __construct(WebpageModel $model, Template $template) {
        $this->model = $model;
        $this->template = $template;
        
        $this->template->set('ROOT', WEB_ROOT);
        $this->template->set('SITE', WEB_SITE);
    }
    
    public function output() {
        $data = $this->model->getData();
        $this->template->setData($data);
        return $this->template->output(true);
    }
}

?>