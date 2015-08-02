<?php

class IndexView extends BaseView {
    public function output() {
        $this->checkInstance($this->template, 'Template');
        
        return $this->template->output();
    }
}

?>