<?php

class WebpageView {
    private $model;
    private $template;
    
    protected $bodyTemplate;
    
    public function __construct(WebpageModel $model, Template $template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function output() {
        $data = $this->model->getData();
        $this->template->setData($data);
        if(isset($this->bodyTemplate) )
            $this->template->set('main-content', $this->bodyTemplate->output() );
        return $this->template->output(true);
    }
}

?>