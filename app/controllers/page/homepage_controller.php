<?php

class Homepage_controller extends Controller {
    public function index($args=null) {
        echo 'page/homepage->index';
        if(!is_null($args) ) {
            echo '(';
            foreach($args as $arg) {
                echo ' ' . $arg;
            }
            echo ' )';
        }
    }
    
    public function index2($args=null) {
        Loader::load_model('story/story');
        Loader::load_view('story/story');
        Loader::load_view('story/story2');
        Loader::load_controller('story/story');
        
        
        $id = 1;
        if(count($args)>0) {
            $id = $args[0];
        }
        
        $id2 = 1;
        if(count($args)>1) {
            $id2 = $args[1];
        }
        
        $model = new Story_model;
        $controller = new Story_controller($model);
        $view = new Story_view($model);
        $view2 = new Story2_view($model);
        
        $controller->set_story_by_id($id);
        $view->show_story();
        $view2->show_story();
        
        $controller->set_story_by_id($id2);
        $view->show_story();
        $view2->show_story();
    }
}

?>