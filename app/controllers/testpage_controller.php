<?php

class Testpage_controller extends Controller {
    public function index() {
        $tpl = new Template('page/3-col', array('ROOT'=>WEB_ROOT) );
        
        $tpl_item = new Template('story/story_mini');
        $tpl_item->repeat(3);
        
        $model = new Story_model;
        $model->set_criteria('sel', array('id'=>2) );
        $item1 = $model->get_item();
        $model->set_criteria('sel', array('id'=>3) );
        $item2 = $model->get_item();
        $model->set_criteria('sel', array('id'=>4) );
        $item3 = $model->get_item();
        
        $tpl_item->set_data($item1, 1);
        $tpl_item->set_data($item2, 2);
        $tpl_item->set_data($item3, 3);
        
        $tpl->include_template('content-center', $tpl_item);
        
        
        
        $model->set_criteria('sel', array('id'=>15) );
        $item4 = $model->get_item();
        
        $tpl_item2 = new Template('story/story_mini');
        $tpl_item2->set_data($item4);
        
        $tpl->include_template('content-right', $tpl_item2);
        
        
        $tpl_nav = new Template('story/story_mini');
        $tpl_nav->repeat(2);
        $tpl_nav->set('title', 'st1', 1);
        $tpl_nav->set('title', 'st2', 2);
        
        $tpl->set('story-link', '/test/item');
        $tpl->set('nav-lang-retlink', '/test');
        
        $tpl->include_template('content-left', $tpl_nav);
        
        $tp = &$tpl->get_template('content-left');
        if(!is_null($tp) ) {
            $tp->repeat(1);
        }
        
        echo $tpl->output(true, true);
    }
    
    public function pagination($page=1) {
        if(!is_numeric($page) || $page<1)
            $page = 1;
        
        $model = new Story_model;
        $model->set_page($page);
        
        $template = new Template('pagination');
        $tpl = new Template('story/story_mini');
        $tpl2 = new Template(' <a {@curr-num} href="{@ROOT}/test/pagination/{@num}">{@num}</a> ', null, true);
        
        $template->include_template('items', $tpl);
        $template->include_template('pages', $tpl2);
        $template->set('page-current', 'class="selected"');
        $template->set('ROOT', WEB_ROOT);
        $template->set('SITE', WEB_SITE);
        $template->set('story-link', '/test/region');
        
        $view = new Pagination_view($model, $template);
        echo $view->output();
    }
    
    public function region($id=1) {
        if(!is_numeric($id) || $id<1) {
            $id = 1;
        }
        
        $model = new Story_model;
        $model->set_criteria('sel', array('id'=>$id) );
        
        $template = new Template('
<div class="region">
{@content}
</div>', null, true);
        $template_item = new Template('story/story_full');
        $template->include_template('content', $template_item);
        
        $region_view = new Region_view($model, $template);
        echo $region_view->output();
    }
}

?>