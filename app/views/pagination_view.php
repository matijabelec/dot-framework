<?php

class Pagination_view {
    private $model;
    private $template;
    private $template_items;
    private $template_pages;
    
    public function __construct(iPageable $model,
                                Template $template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function set_template($key, Template $template) {
        switch($key) {
            case '':
            case 'template':
                if(isset($this->template) )
                    unset($this->template);
                $this->template = $template;
                break;
            
            case 'items':
                if(isset($this->template_items) )
                    unset($this->template_items);
                $this->template_items = $template;
                break;
            
            case 'pages':
                if(isset($this->template_pages) )
                    unset($this->template_pages);
                $this->template_pages = $template;
                break;
            
            default:
                break;
        }
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
        
        if(isset($this->template_items) && !is_null($this->template_items) ) {
            $tpli = Template::merge($this->template_items, count($items) );
        } else {
            $tpl_i = new Template('[item]<br/>', true);
            $tpli = Template::merge($tpl_i, count($items) );
        }
        
        if(isset($this->template_pages) && !is_null($this->template_pages) ) {
            $tplp = Template::merge($this->template_pages, $pages_num);
        } else {
            $tpl_p = new Template(' {@num}', true);
            $tplp = Template::merge($tpl_p, $pages_num);
        }
        
        $this->template->set('pages', $tplp);
        $this->template->set('items', $tpli);
        
        $this->template->fill(false, true);
        
        for($i=1; $i<=$pages_num; $i++) {
            $this->template->set('num-'.$i, $i);
            if($i==$current_page)
                $this->template->set('curr-num-'.$i, '{@page-current}');
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
        
        $this->template->fill(false, true);
        $this->template->fill();
        return $this->template->output();
    }
}

?>