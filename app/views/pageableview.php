<?php

class PageableView extends BaseView {
    public function output() {
        $this->checkInstance($this->model, 'iPageable');
        $this->checkInstance($this->template, 'Template');
        
        /*
         * calculate number of pages 
         */
        $recordsN = $this->model->getRecordsMax();
        $recordsPerPage = $this->model->getRecordsPerPage();
        $pagesN = ceil($recordsN/$recordsPerPage);
        
        /*
         * calculate offset from beginning for records 
         */
        $pageCurrent = $this->model->getCurrentPage();
        $offset = ($pageCurrent-1) * $recordsPerPage;
        
        /*
         * get records from current page and set data to template 
         */
        $records = $this->model->getRecords($recordsPerPage, $offset);
        foreach($records as $key=>$val)
            $this->template->set($key, $val);
        
        /*
         * fill template and return view 
         */
        return $this->template->output();
    }
}

?>