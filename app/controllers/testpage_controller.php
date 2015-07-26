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
    
    public function index($args) {
        $this->prepare('page/2-col');
        
        $this->set_defaults();
        $this->set_title('Test - home');
        
        $this->add_css('col-tpl-styles');
        
        $story_list = new Storypage_controller();
        
        $stories_left = $story_list->get_story(12);
        $stories_left .= $story_list->get_story(15);
        
        $stories_right = $story_list->get_page(3);
        
        $this->add_data('content-left', $stories_left);
        $this->add_data('content-right', $stories_right);
        
        $this->show();
    }
    
    public function about($args) {
        $this->prepare('page/3-col');
        
        $this->set_defaults();
        $this->set_title('Test - about');
        
        $this->add_css('col-tpl-styles');
        
        
        $story_list = new Storypage_controller();
        
        $stories_left = $story_list->get_page(1);
        $stories_left .= $story_list->get_page(2);
        $stories_left .= $story_list->get_page(3);
        $stories_left .= $story_list->get_page(4);
        
        $stories_center = $story_list->get_page(5);
        $stories_center .= $story_list->get_page(6);
        
        $stories_right = $story_list->get_page(7);
        
        
        $this->add_data('content-left', $stories_left);
        $this->add_data('content-center', $stories_center);
        $this->add_data('content-right', $stories_right);
        
        $this->show();
    }
}

?>