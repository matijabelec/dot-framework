<?php

class Storypage_controller extends Webpage_controller {
    public function view($args) {
        if(count($args) < 1) return;
        
        $id = $args[0];
        
        $model = new Story_model;
        $controller = new Story_controller($model);
        $controller->set_story_by_id($id);
        
        $template = new Template('story/story_full');
        $view = new Story_view($model, $template);
        $page = $view->show();
        
        
        $page_model = new Home_model;
        $this->show_webpage($page_model, $page);
    }
}

?>