<?php

class Pagination_view {
    private $model;
    private $template;
    
    public function __construct(iPageable $model,
                                Template $template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function output() {
        $items_per_page = $this->model->get_items_per_page();
        $current_page = $this->model->get_current_page();
        if(!isset($current_page) || !is_numeric($current_page) 
           || !is_numeric($current_page) || $current_page<1) {
               $current_page = 1;
        }
        
        $num_of_items = $this->model->get_results_number();
        $pages_num = ceil($num_of_items / $items_per_page);
        
        $data = $this->model->get_items($items_per_page, ($current_page-1)*$items_per_page);
        $data_n = count($data);
        
        $pages = &$this->template->get_template('pages');
        $items = &$this->template->get_template('items');
        
        if(!is_null($items) && !is_null($pages) ) {
            $items->repeat($data_n);
            $pages->repeat($pages_num);
            
            for($i=1; $i<=$pages_num; $i++) {
                $pages->set('num', $i, $i);
                if($i==$current_page)
                    $pages->set('curr-num', '{@page-current}', $i);
            }
            
            for($i=0; $i<$data_n; $i++)
                if(is_array($data[$i]) )
                    $items->set_data($data[$i], $i+1);
        }
        
        return $this->template->output(true, true);
    }
}

?>