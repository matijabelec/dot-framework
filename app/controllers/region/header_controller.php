<?php

class Header_controller {
    private $model;
    private $view;
    private $lang;
    
    public function __construct($lang) {
        $this->model = new Region_model('region/header', $lang);
        $template = new Template('header');
        
        $this->view = new Region_view($this->model, $template);
        $this->lang = $lang;
    }
    
    public function set_title($title) {
        if(isset($title) )
            $this->model->set('main-page-title', $title);
    }
    
    public function add_css($filename) {
        $css = $this->model->get('CSS-DATA');
        if(is_null($css) )
            $css = '';
        $css .= '
<link rel="stylesheet" href="' . SITE_CSS . '/' . $filename . '.css">';
        $this->model->set('CSS-DATA', $css);
    }
    public function add_css_inline($style) {
        $css = $this->model->get('CSS-DATA');
        if(is_null($css) )
            $css = '';
        $css .= '
<style>
' . $style . '
</style>';
        $this->model->set('CSS-DATA', $css);
    }
    
    public function output() {
        return $this->view->output();
    }
}

?>