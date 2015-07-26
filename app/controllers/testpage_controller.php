<?php

class Testpage_controller extends Webpage_controller {
    public function index() {
        $tpl = new Template('page/3-col');
        
        $tpl_item = new Template('story/story_mini');
        $tpl_item->repeat(3);
        
        $model = new Story_model;
        $model->set_criteria('sel', array('id'=>2) );
        $item1 = $model->get_item();
        $model->set_criteria('sel', array('id'=>3) );
        $item2 = $model->get_item();
        $model->set_criteria('sel', array('id'=>4) );
        $item3 = $model->get_item();
        $tpl_item->
        $tpl_item->set_data($item1, 1);
        $tpl_item->set_data($item2, 2);
        $tpl_item->set_data($item3, 3);
        
        $items = $tpl_item->output();
        $tpl->
        $tpl->set('content-center', $items);
        
        echo $tpl->output();
    }
    
    /*protected function set_defaults() {
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
        $this->add_data('nav-lang-retlink', '/test');
        
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
        $this->add_data('nav-lang-retlink', '/test/about');
        
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
    
    public function region() {
        $this->prepare('page/1-col');
        $this->add_data('nav-lang-retlink', '/test/region');
        
        $this->set_defaults();
        $this->add_langfile('page/test');
        
        $this->add_css('col-tpl-styles');
        
        
        $model = new Story_model;
        $model->set_criteria('sel', array('id'=>1) );
        
        $template = new Template('
<div class="region">
{@item}
</div>', true);
        $template_item = new Template('story/story_full');
        $region_view = new Region_view($model, $template, $template_item);
        $region_view2 = new Region_view($model, $template, $template_item);
        
        $page = $region_view->output();
        $page .= $region_view2->output();
        
        
        $this->add_data('content', $page);
        
        $this->show();
    }*/
}

?>