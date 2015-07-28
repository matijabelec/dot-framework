<?php

class Testpage_view {
    private $controller;
    private $model;
    
    public function __construct($controller, $model) {
        $this->controller = $controller;
        $this->model = $model;
    }
    
    public function output() {
        $lang = $this->model->getLang();
        $body = $this->model->getBody();
        
        $header = new Template('standard/header', array('ROOT'=>WEB_ROOT, 'SITE'=>WEB_SITE) );
        $header->set('META-DATA', '<meta name="author" content="Matija Belec"/>');
        $header->set('CSS-DATA', '<link rel="stylesheet" href="test.css"/>');
        $header->set('main-page-title', '@Matija\'s place');
        $header->set('header-title', 'MatijaBelec.com');
        
        $nav = new Template('standard/nav', array('ROOT'=>WEB_ROOT, 'SITE'=>WEB_SITE) );
        $nav->set('nav-lang-retlink', '/');
        $nav->set('nav-home', 'Home');
        $nav->set('nav-about', 'About');
        
        $footer = new Template('standard/footer', array('ROOT'=>WEB_ROOT, 'SITE'=>WEB_SITE) );
        $footer->set('rights', 'All Rights Reserved');
        $footer->set('JS-DATA', '<script></script>');
        
        
        $safe = false;
        $content = $header->output();
        $content .= $nav->output();
        $content .= $body->output($safe);
        $content .= $footer->output();
        
        return $content;
    }
}

?>