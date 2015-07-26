<?php

class Storypage_controller extends Controller {
    public function index() {
        Router::redirect('/story/page/1');
    }
    
    public function page($page) {
        if(!isset($page) )
            return STATUS_ERR;
        
        // show story list
        if(!is_numeric($page) || $page<1)
            return STATUS_ERR;
        
        $model = new Story_model;
        $model->set_page($page);
        
        $tpl = new Template('story/story_list');
        $tpl_item = new Template('story/story_mini');
        $tpl_num = new Template(' <a {@curr-num} href="{@ROOT}/story/page/{@num}">{@num}</a> ', true);
        $tpl->set('page-current', 'class="selected"');
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
        
        echo $stories_container;
    }
    
    public function view($id) {
        if(!isset($id) )
            return STATUS_ERR;
        
        $model = new Story_model;
        $model->set_criteria('sel', array('id'=>$id) );
        
        $template = new Template('story/story_full');
        
        $view = new Story_view($model, $template);
        $story = $view->show();
        
        unset($view);
        unset($model);
        unset($template);
        
        echo $story;
    }
}

?>