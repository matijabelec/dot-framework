<?php

class Footer_controller {
    private $view;
    private $lang;
    
    public function __construct($lang) {
        $model = new Region_model('region/footer', $lang);
        $template = new Template('footer');
        
        $this->view = new Region_view($model, $template);
        $this->lang = $lang;
    }
    
    public function output() {
        return $this->view->output();
    }
}

?>