<?php

class Homepage_controller extends Controller {
    public function index($args) {
        
        // body
        $tpl = new Template('body/homepage');
        $tpl->set('story-id', 3);
        $tpl->fill(false);
        $body = $tpl->output();
        
        // webpage
        $model = new Webpage_model;
        $template = new Template('page');
        $view = new Webpage_view($model, $template);
        
        $model->add_data('content', $body);
        $model->add_data('title', 'Storypage');
        
        echo $view->show();
    }
}

?>