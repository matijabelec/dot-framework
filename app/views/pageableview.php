<?php

class PageableView extends BaseView {
    public function render() {
        $this->checkInstance($this->model, 'iPageable');
        $this->checkInstance($this->template, 'Template');
        
        /*
         * Calculate number of pages.
         */
        $recordsN = $this->model->getRecordsMax();
        $recordsPerPage = $this->model->getRecordsPerPage();
        $pagesN = ceil($recordsN/$recordsPerPage);
        
        /*
         * Calculate offset from beginning for records.
         */
        $pageCurrent = $this->model->getCurrentPage();
        $offset = ($pageCurrent-1) * $recordsPerPage;
        
        /*
         * Get records from current page and set data to template.
         */
        $records = $this->model->getRecords($recordsPerPage, $offset);
        foreach($records as $key=>$val)
            $this->template->set($key, $val);
        
        /*
         * Fill template and return view.
         */
        return $this->template->output();
    }
}

?>