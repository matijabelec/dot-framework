<?php

class PageableView extends View {
    private $model;
    private $template;
    
    public function __construct(iPageable &$model, Template &$template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function output() {
        // get pages data and calculate maximum number of pages
        $perPage = $this->model->getPerPage();
        $recordsMax = $this->model->getRecordsMaxCount();
        $pagesN = ceil($recordsMax/$perPage);
        
        // check if page is set correctly or return empty string
        $currentPage = $this->model->getCurrentPage();
        if($currentPage<1 || $currentPage>$pagesN)
            return '';
        
        // get data
        $data = $this->model->getPageRecords($perPage, ($currentPage-1)*$perPage);
        $dataN = (is_array($data) ? count($data) : 0);
        
        // if there is data then fill template with data
        if($data>0) {
            $this->template->repeat($dataN);
            for($i=1; $i<=$dataN; $i++)
                $this->template->setData($data[$i-1], $i);
            return $this->template->output();
        }
        
        // if no data then return empty string
        return '';
    }
}

?>