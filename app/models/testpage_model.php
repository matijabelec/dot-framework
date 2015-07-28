<?php

class Testpage_model {
    private $body = '';
    
    public function setBody(Template $template) {
        if(isset($template) )
            $this->body = $template;
    }
    
    public function getLang() {
        return Lang_controller::get();
    }
    
    public function getBody() {
        return $this->body;
    }
}

?>