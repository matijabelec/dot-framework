<?php

class Pagination_view {
    private $model;
    private $template;
    
    public function __construct(iPageable $model,
                                Template $template) {
        $this->model = $model;
        $this->template = $template;
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
        
        for($i=1; $i<=$pages_num; $i++) {
            $this->template->set('num-'.$i, $i);
        }
        
        $i = 1;
        foreach($items as $item) {
            if(is_array($item) ) {
                foreach($item as $k=>$v) {
                    $this->template->set($k.'-'.$i, $v);
                }
            }
            $i++;
        }
        
        $this->template->fill();
        return $this->template->output();
    }
}

?>