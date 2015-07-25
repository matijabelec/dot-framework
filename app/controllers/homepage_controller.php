<?php

class Homepage_controller extends Controller {
    public function index($args=null) {
        $page = 1;
        if(count($args)>0) {
            $page = $args[0];
        }
        
        $model = new Story_model;
        $model->set_page($page);
        
        
        
        $tpl = new Template('story/story_list');
        $tpl->set('title', 'Test title');
        $tpl->fill(false, true);
        
        $tpl_item = new Template('story/story_mini');
        $ni = $model->get_current_page_items_count();
        $items = '';
        for($i=1; $i<=$ni; $i++) {
            $tpl_item->set_data(array('id'=>'{@id-'.$i.'}',
                                 'title'=>'{@title-'.$i.'}',
                                 'text'=>'{@text-'.$i.'}') );
            $tpl_item->fill();
            $items .= $tpl_item->output();
        }
        $tpl->set('items', $items);
        
        
        $tpl_num = new Template(' <a href="{@ROOT}/home/page/{@num}">{@num}</a> ', true);
        $np = $model->get_pages_count();
        $pages = '';
        for($i=1; $i<=$np; $i++) {
            $tpl_num->set_data(array('num'=>'{@num-'.$i.'}') );
            $tpl_num->fill();
            $pages .= $tpl_num->output();
        }
        $tpl->set('pages', $pages);
        $tpl->fill(false, true);
        
        
        $view = new Pagination_view($model, $tpl, $tpl_item, $tpl_num);
        echo $view->show();
    }
}

?>