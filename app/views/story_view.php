<?php

class Story_view {
    private $model;
    private $template;
    
    public function __construct(iListable $model, Template $template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function show() {
        $data = $this->model->get_item();
        
        if(!is_null($data) )
            $this->template->set_data($data);
        
        $this->template->fill();
        return $this->template->output();
    }
}

?>