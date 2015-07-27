<?php

class Homepage_model implements iWebpage {
    private $lang = 'en';
    private $data = array();
    
    public function __construct($lang) {
        if(isset($lang) )
            $this->lang = $lang;
    }
    
    public function get_data() {
        $this->data['nav-lang-retlink'] = '/';
        $this->load_lang_data('page/test', $this->lang);
        return $this->data;
    }
    
    public function load_lang_data($langfile, $lang) {
        $data = Loader::get_langfile($langfile, $lang);
        if(is_null($data) )
            return false;
        foreach($data as $key => $val) {
            $this->data[$key] = $val;
        }
        return true;
    }
}

?>