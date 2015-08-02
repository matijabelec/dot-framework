<?php

class MultilangFile {
    private $lang;
    private $file;
    
    private $data;
    private $dataLang;
    
    public function __construct($name) {
        $this->lang = DEFAULT_LANGUAGE;
        $this->file = APP_MULTILANGS . $name . '.mlf';
        $this->data = null;
    }
    
    private function cache() {
        $this->data = []; //load data
        $this->dataLang = $this->lang;
    }
    
    public function setLanguage($language) {
        $this->lang = $language;
    }
    
    public function get($key) {
        if(!isset($this->data) || $this->dataLang=$this->lang) {
            $this->cache();
        }
        
        foreach($this->data as &$group) {
            foreach($group as $k=>&$v) {
                if($k == $key) {
                    return $v;
                }
            }
        }
        return null;
    }
    
    public function getGroup($group) {
        if(!isset($this->data) || $this->dataLang=$this->lang) {
            $this->cache();
        }
        
        if(isset($this->data[$group]) ) {
            return $this->data[$group];
        }
        return null;
    }
}

?>