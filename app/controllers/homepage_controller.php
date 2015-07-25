<?php

class Homepage_controller extends Controller {
    public function index($args=null) {
        $model = new Story_model;
        $controller = new Story_controller($model);
        
        $template = new Template('story/story_list');
        $template->set('title', 'Test title');
        $tpl_item = new Template('story/story_mini');
        $tpl_num = new Template(' <a href="{@ROOT}/index/index/{@num}">{@num}</a> ', true);
        $tpl_num->set('ROOT', WEB_ROOT);
        $view = new Pagination_view($model, $template, $tpl_item, $tpl_num);
        
        $page = 1;
        if(count($args)>0) {
            $page = $args[0];
        }
        
        $controller->set_page($page);
        $cnt = $view->show();
        
        
        $page_mdl = new Home_model;
        $this->show_webpage($page_mdl, $cnt);
    }
    
    protected function show_webpage($page_mdl, $content) {
        $page_ctrl = new Webpage_controller($page_mdl);
        $page_ctrl->add_data('content', $content);
        
        $page_tpl = new Template('page');
        $page_view = new Webpage_view($page_mdl, $page_tpl);
        echo $page_view->show();
    }
}

?>