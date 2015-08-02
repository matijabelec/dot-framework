<?php

class IndexView extends BaseView {
    public function output() {
        $this->template->name = 'test';
        $this->template->tekst = 'test-text';
        
        $this->model->getPage();
        
        return $this->template->output();
    }
}

?>