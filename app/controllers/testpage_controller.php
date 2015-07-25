<?php

class Testpage_controller extends Webpage_controller {
    public function index($args) {
        $this->prepare('page/2-col');
        
        $this->add_meta('author', 'Matija Belec');
        $this->add_meta('date', '26 jul 2015');
        
        $this->add_css('test');
        $this->add_css('test2');
        
        $this->add_js('test');
        $this->add_js('test2');
        
        $this->set_title('Test');
        
        $this->show();
    }
}

?>