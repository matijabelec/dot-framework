<?php

class Pagination_view {
    private $model;
    private $template;
    private $template_item;
    private $template_num;
    
    public function __construct(Pageable $model,
                                Template $tpl_page,
                                Template $tpl_item,
                                Template $tpl_pnum=null) {
        $this->model = $model;
        $this->template = $tpl_page;
        $this->template_item = $tpl_item;
        $this->template_num = $tpl_pnum;
    }
    
    public function show() {
        $items_per_page = $this->model->get_items_per_page();
        $current_page = $this->model->get_current_page();
        if(!isset($current_page) || !is_numeric($current_page) 
           || !is_numeric($current_page) || $current_page<1) {
               $current_page = 1;
        }
        
        $num_of_items = $this->model->get_results_number();
        $pages_num = ceil($num_of_items / $items_per_page);
        
        $items = $this->model->get_items($items_per_page, ($current_page-1)*$items_per_page);
        
        $ps = '';
        if(isset($this->template_num) ) {
            for($i=1; $i<=$pages_num; $i++) {
                $this->template_num->set('num', $i);
                $this->template_num->fill();
                $ps .= $this->template_num->output();
            }
        } else {
            for($i=1; $i<=$pages_num; $i++) {
                $ps .= $i;
            }
        }
        $this->template->set('pages', $ps);
        
        $is = '';
        foreach($items as $item) {
            if(is_array($item) ) {
                foreach($item as $k=>$v) {
                    $this->template_item->set($k, $v);
                }
                $this->template_item->fill();
                $is .= $this->template_item->output();
            }
        }
        
        $this->template->set('items', $is);
        
        $this->template->fill();
        return $this->template->output();
    }
}

?>