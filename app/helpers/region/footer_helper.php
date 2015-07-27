<?php

class Footer_helper {
    private $view;
    private $lang;
    
    public function __construct($lang) {
        $model = new Model;
        $template = new Template('footer');
        
        $this->view = new Footer_view($model, $template);
        $this->lang = $lang;
    }
    
    public function output() {
        //$model->get_lang_data('footer', $lang);
        return $this->view->output();
    }
}

?>