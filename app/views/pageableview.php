<?php

class PageableView extends BaseView {
    public function output() {
        $this->checkInstance($this->model, 'iPageable');
        $this->checkInstance($this->template, 'Template');
        
        
        
        return $this->template->output();
    }
}

?>