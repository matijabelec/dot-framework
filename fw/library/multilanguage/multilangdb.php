<?php

class MultilangDB {
    private $lang;
    private $file;
    
    public function __construct($name) {
        $this->lang = DEFAULT_LANGUAGE;
        $this->file = APP_MULTILANGS . $name . '.mlf';
        $this->data = null;
    }
    
    public function setLanguage($language) {
        $this->lang = $language;
    }
    
    public function get($key) {
        
        return null;
    }
    
    public function getGroup($group) {
        
        return null;
    }
}

?>