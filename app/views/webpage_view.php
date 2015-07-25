<?php

class Webpage_view {
    private $model;
    private $template;
    
    public function __construct(iWebpage $model, Template $template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function show() {
        $this->template->set('SITE', WEB_SITE);
        $this->template->set('ROOT', WEB_ROOT);
        
        $data = $this->model->get_data();
        if(!is_null($data) && is_array($data) ) {
            foreach($data as $k=>$v)
                $this->template->set($k, $v);
        }
        
        $this->template->fill(false, true);
        $this->template->fill();
        return $this->template->output();
    }
}

?>