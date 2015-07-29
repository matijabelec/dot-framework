<?php

class WebpageView {
    private $model;
    
    public function __construct(WebpageModel $model) {
        $this->model = $model;
    }
    
    public function output() {
        $lang = $this->model->getLang();
        
        $title = $this->model->getPageTitle();
        $meta = $this->model->getDataMeta();
        $css = $this->model->getDataCss();
        $header = new Template('standard/header', array('ROOT'=>WEB_ROOT, 'SITE'=>WEB_SITE) );
        $header->set('META-DATA', $meta);
        $header->set('CSS-DATA', $css);
        $header->set('main-page-title', $title);
        $header->set('header-title', 'MatijaBelec.com');
        $content = $header->output();
        
        $nav = new Template('standard/nav', array('ROOT'=>WEB_ROOT, 'SITE'=>WEB_SITE) );
        $nav->set('nav-lang-retlink', '/');
        $nav->set('nav-home', 'Home');
        $nav->set('nav-about', 'About');
        $content .= $nav->output();
        
        $regions = $this->model->getRegions();
        if(!is_null($regions) && is_array($regions) ) {
            foreach($regions as $region)
                $content .= $region->output();
        }
        
        $footer = new Template('standard/footer', array('ROOT'=>WEB_ROOT, 'SITE'=>WEB_SITE) );
        $footer->set('rights', 'All Rights Reserved');
        $footer->set('JS-DATA', '<script></script>');
        $content .= $footer->output();
        
        return $content;
    }
}

?>