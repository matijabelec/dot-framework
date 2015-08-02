<?php

class IndexView extends BaseView {
    public function output() {
        $this->template->name = 'test';
        $this->template->tekst = 'test-text';
        $this->template->set('tes-2', 'bxbcrrhtrjt');
        
        $this->model->getPage();
        
        return $this->template->output();
    }
}

?>