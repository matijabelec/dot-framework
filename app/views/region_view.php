<?php

class Region_view {
    private $model;
    private $template;
    private $template_item;
    
    public function __construct(iListable $model,
                                Template $template,
                                Template $template_item) {
        $this->model = $model;
        $this->template = $template;
        $this->template_item = $template_item;
    }
    
    public function output() {
        $data = $this->model->get_item();
        
        $this->template_item->set_data($data);
        $this->template_item->fill();
        $item = $this->template_item->output();
        
        $this->template->set('item', $item);
        
        $this->template->fill(false, true);
        $this->template->fill();
        return $this->template->output();
    }
}

?>