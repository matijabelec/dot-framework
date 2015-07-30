<?php

class WebpageTemplate extends Template {
    private $lang;
    
    public function __construct($name, $data=null) {
        parent::__construct($name, $data);
        
        $this->set('META-DATA', '');
        $this->set('CSS-DATA', '
<link rel="stylesheet" href="'.SITE_CSS.'/style.css">');
        
        $this->lang = 'en';
        $this->setTitle('Unknown');
    }
    
    public function setLang($lang) {
        $this->lang = $lang;
    }
    
    public function setTitle($title) {
        $this->set('head-title', $title);
    }
    
    public function output($safe=true) {
        $headerData = Loader::getLangfile('region/header', $this->lang);
        $navData = Loader::getLangfile('region/nav', $this->lang);
        $footerData = Loader::getLangfile('region/footer', $this->lang);
        
        $this->setData($headerData);
        $this->setData($navData);
        $this->setData($footerData);
        
        return parent::output($safe);
    }
}

?>