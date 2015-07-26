<?php

class Testpage_controller extends Webpage_controller {
    protected function set_defaults() {
        $this->add_meta('keywords', 'CV,matijabelec,personal webpage');
        $this->add_meta('description', 'Matija Belec\'s CV');
        $this->add_meta('author', 'Matija Belec');
        //$this->add_meta('', 'http-equiv="refresh" content="30"', true);
        
        $this->add_css('test');
        $this->add_css('test2');
        
        $this->add_js('test');
        $this->add_js('test2');
        
        $this->set_title('Test');
    }
    
    public function index() {
        $this->prepare('page/2-col');
        
        $this->set_defaults();
        $this->set_title('Test - home');
        
        $this->add_css('col-tpl-styles');
        
        $story_list = new Storypage_controller();
        
        ob_start();
            $story_list->view(12);
            $story_list->view(15);
            
            $stories_left = ob_get_contents();
        ob_end_clean();
        
        ob_start();
            $story_list->page(3);
            $stories_right = ob_get_contents();
        ob_end_clean();
        
        $this->add_data('content-left', $stories_left);
        $this->add_data('content-right', $stories_right);
        
        $this->show();
    }
    
    public function about() {
        $this->prepare('page/3-col');
        
        $this->set_defaults();
        $this->add_langfile('page/test');
        
        $this->add_css('col-tpl-styles');
        
        
        $story_list = new Storypage_controller();
        
        ob_start();
            $story_list->page(1);
            $story_list->page(2);
            $story_list->page(3);
            $story_list->page(4);
            
            $stories_left = ob_get_contents();
        ob_end_clean();
        
        ob_start();
            $story_list->page(5);
            $story_list->page(6);
            $stories_center = ob_get_contents();
        ob_end_clean();
        
        ob_start();
            $story_list->page(7);
            $stories_right = ob_get_contents();
        ob_end_clean();
        
        
        $this->add_data('content-left', $stories_left);
        $this->add_data('content-center', $stories_center);
        $this->add_data('content-right', $stories_right);
        
        $this->show();
    }
}

?>