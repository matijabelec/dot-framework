<?php

class Storypage_controller extends Controller {
    public function index($args) {
        if(count($args)>0) {
            $page = $args[0];
        } else {
            Router::redirect('/story/page/1');
        }
        
        // story list
        $stories_container = $this->get_stories_container($page);
        
        echo $stories_container;
    }
    private function get_stories_container($page) {
        $model = new Story_model;
        $model->set_page($page);
        
        $tpl = new Template('story/story_list');
        $tpl_item = new Template('story/story_mini');
        $tpl_num = new Template(' <a {@curr-num} href="{@ROOT}/story/page/{@num}">{@num}</a> ', true);
        //$tpl->set('page-current', 'class="selected"');
        $view = new Pagination_view($model, $tpl);
        $view->set_template('items', $tpl_item);
        $view->set_template('pages', $tpl_num);
        
        $stories_container = '<style>a{color: #ff0000;text-decoration: none;} .selected{color: #000000;}</style>';
        $stories_container .= $view->show();
        
        unset($view);
        unset($model);
        unset($tpl);
        unset($tpl_item);
        unset($tpl_num);
        
        return $stories_container;
    }
    
    
    
    
    
    public function view($args) {
        if(count($args) < 1) return;
        $id = $args[0];
        $story = $this->get_story($id);
        
        echo $story;
    }
    private function get_story($id) {
        $model = new Story_model;
        $model->set_criteria('sel', array('id'=>$id) );
        
        $template = new Template('story/story_full');
        
        $view = new Story_view($model, $template);
        $story = $view->show();
        
        unset($view);
        unset($model);
        unset($template);
        
        return $story;
    }
}

?>