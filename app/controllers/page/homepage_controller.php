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
        $id = 1;
        if(count($args)>0) {
            $id = $args[0];
        }
        
        $id2 = 1;
        if(count($args)>1) {
            $id2 = $args[1];
        }
        
        $model = Loader::get_model('story/story');
        
        $controller = Loader::get_controller('story/story', $model);
        
        $view = Loader::get_view('story/story', $model);
        $view2 = Loader::get_view('story/story_mini', $model);
        
        
        $page = '';
        
        $controller->set_story_by_id($id);
        $page .= $view->show_story();
        $page .= $view2->show_story();
        
        $controller->set_story_by_id($id2);
        $page .= $view2->show_story();
        
        echo $page;
    }
    
    public function index3($args=null) {
        $model = Loader::get_model('story/story');
        
        $controller = Loader::get_controller('story/story', $model);
        
        $template = new Template('pagination');
        $tpl_item = new Template('story/story_mini');
        $tpl_num = new Template('<span> {@num} </span>', true);
        
        Loader::load_view('pagination');
        $view = new Pagination_view($model, $template, $tpl_item, $tpl_num);
        
        
        $page = 1;
        if(count($args)>0) {
            $page = $args[0];
        }
        
        $controller->set_page($page);
        
        echo $view->show();
    }
}

?>