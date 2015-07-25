<?php

class Storypage_controller extends Webpage_controller {
    public function view($args) {
        if(count($args) < 1) return;
        
        $id = $args[0];
        
        $model = new Story_model;
        $model->set_criteria('sel', array('id'=>$id) );
        
        $template = new Template('story/story_full');
        
        $view = new Story_view($model, $template);
        echo $view->show();
    }
}

?>