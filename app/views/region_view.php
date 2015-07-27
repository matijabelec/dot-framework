<?php

class Region_view {
    private $model;
    private $template;
    
    public function __construct(iListable $model,
                                Template $template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function output() {
        $data = $this->model->get_item();
        
        $tpl = &$this->template->get_template('content');
        if(!is_null($tpl) ) {
            $tpl->set_data($data);
        }
        
        return $this->template->output();
    }
}

?>