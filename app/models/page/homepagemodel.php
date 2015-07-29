<?php

class HomepageModel extends WebpageModel {
    private $langData;
    
    public function __construct() {
        $this->langData = Loader::getLangfile('region/header', 'en');
        $this->langData += Loader::getLangfile('region/nav', 'en');
        $this->langData += Loader::getLangfile('region/footer', 'en');
    }
    
    public function getData() {
        return $this->langData;
    }
}

?>