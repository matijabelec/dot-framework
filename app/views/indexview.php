<?php

class IndexView extends BaseView {
    public function render() {
        $this->checkInstance($this->template, 'Template');
        
        return $this->template->output();
    }
}

?>