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
        
        $tpl_item->set_data($item1, 1);
        $tpl_item->set_data($item2, 2);
        $tpl_item->set_data($item3, 3);
        
        $items = $tpl_item->output();
        
        $tpl->set('content-center', $items);
        
        $model->set_criteria('sel', array('id'=>15) );
        $item4 = $model->get_item();
        
        $tpl_item->repeat(1);
        $tpl_item->set_data($item4);
        $item_only = $tpl_item->output();
        
        
        $tpl->set('content-right', $item_only);
        
        
        $tpl_nav = new Template('story/story_mini');
        $tpl_nav->repeat(2);
        $tpl_nav->set('title', 'st1', 1);
        $tpl_nav->set('title', 'st2', 2);
        
        $tpl->include_template('content-left', $tpl_nav);
        
        $tp = &$tpl->get_template('content-left');
        if(!is_null($tp) ) {
            $tp->repeat(1);
        }
        
        echo $tpl->output(true, true);
    }
    
    public function pagination($page) {
        if(!isset($page) && !is_numeric($page) )
            $page = 1;
        
        $model = new Story_model;
        $model->set_page($page);
        
        $template = new Template('pagination');
        $tpl = new Template('story/story_mini');
        $tpl2 = new Template(' <a {@curr-num} href="{@ROOT}/story/page/{@num}">{@num}</a> ', true);
        
        $template->include_template('items', $tpl);
        $template->include_template('pages', $tpl2);
        $template->set('page-current', 'class="selected"');
        
        $view = new Pagination_view($model, $template);
        echo $view->output();
    }
    
    public function region() {
        $model = new Story_model;
        $model->set_criteria('sel', array('id'=>6) );
        
        $template = new Template('
<div class="region">
{@content}
</div>', true);
        $template_item = new Template('story/story_full');
        $template->include_template('content', $template_item);
        
        $region_view = new Region_view($model, $template);
        
        echo $region_view->output();
    }
}

?>