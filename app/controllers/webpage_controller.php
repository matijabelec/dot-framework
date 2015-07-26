<?php

class Webpage_controller {
    private $model;
    private $template;
    private $view;
    
    private $meta_data = '';
    private $css_data = '';
    private $js_data = '';
    
    private $lang = 'en';
    
    protected function prepare($template_name) {
        $this->lang = Lang_controller::get();
        
        $this->model = new Webpage_model;
        $this->template = new Template($template_name);
        $this->view = new Webpage_view($this->model, $this->template);
    }
    
    protected function add_css($css_filename, $inline=false) {
        if(!isset($css_filename) )
            return;
        
        if($inline == false) {
            $this->css_data .= '
<link rel="stylesheet" href="' . SITE_CSS . '/' . $css_filename . '.css">';
        } else {
            $this->css_data .= '
    <style>' . $css_filename . '</style>';
        }
    }
    
    protected function add_meta($key, $val, $fulltag=false) {
        if($fulltag != false) {
            if(isset($val) ) {
                $this->meta_data .= '
<meta ' . $val . '>';
            }
            
            return;
        }
        
        if(isset($key) && isset($val) )
            $this->meta_data .= '
<meta name="' . $key . '" content="' . $val . '">';
    }
    
    protected function add_js($js_filename, $inline=false) {
        if(!isset($js_filename) )
            return;
        
        if($inline == false) {
            $this->js_data .= '
<script src="' . SITE_JS . '/' . $js_filename . '.js"></script>';
        } else {
            $this->js_data .= '
<script>' . $js_filename . '</script>';
        }
    }
    
    protected function set_title($title) {
        if(isset($title) )
            $this->template->set('main-page-title', $title);
    }
    
    
    
    protected function add_data($key, $val) {
        if($this->model) {
            $this->model->add_data($key, $val);
        }
    }
    
    
    protected function add_langfile($langfile, $lang=null) {
        if($this->model) {
            if(is_null($lang) )
                $lang = $this->lang;
            return $this->model->load_lang_data($langfile, $lang);
        }
        return false;
    }
    
    
    protected function set_lang($lang) {
        if(isset($lang) )
            $this->lang = $lang;
    }
    protected function get_lang($lang) {
        return $this->lang;
    }
    
    
    protected function show() {
        $this->template->set('CSS-DATA', $this->css_data);
        $this->template->set('META-DATA', $this->meta_data);
        $this->template->set('JS-DATA', $this->js_data);
        
        $this->add_langfile('region/nav', $this->lang);
        
        echo $this->view->show();
    }
}

?>