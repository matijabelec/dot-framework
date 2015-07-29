<?php

class PageableView {
    private $model;
    private $template;
    
    protected $recordTemplate;
    protected $pagenumTemplate;
    protected $currentPagenumTemplate;
    
    public function __construct(iPageable $model, Template $template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function output() {
        $perPage = $this->model->getPerPage();
        $recordsMax = $this->model->getRecordsMaxCount();
        $pagesN = ceil($recordsMax/$perPage);
        
        $currentPage = $this->model->getCurrentPage();
        if($currentPage>$pagesN)
            return '';
        
        $records = $this->model->getPageRecords($perPage, ($currentPage-1)*$perPage);
        $recordsN = count($records);
        
        $pagesTpl = '';
        if(isset($this->pagenumTemplate) && is_a($this->pagenumTemplate, 'Template') ) {
            if(isset($this->currentPagenumTemplate)
            && is_a($this->currentPagenumTemplate, 'Template') ) {
                $before = $currentPage-1;
                $after = $pagesN-$currentPage;
                
                if($before > 0 && $before < $pagesN) {
                    $this->pagenumTemplate->repeat($before);
                    for($i=1; $i<=$before; $i++)
                        $this->pagenumTemplate->set('num', $i, $i);
                    $pagesTpl .= $this->pagenumTemplate->output();
                }
                
                if($currentPage <= $pagesN) {
                    $this->currentPagenumTemplate->repeat(1);
                    $this->currentPagenumTemplate->set('num', $currentPage);
                    $pagesTpl .= $this->currentPagenumTemplate->output();
                }
                
                if($after > 0) {
                    $this->pagenumTemplate->repeat($after);
                    for($i=1; $i<=$after; $i++)
                        $this->pagenumTemplate->set('num', $i+$currentPage, $i);
                    $pagesTpl .= $this->pagenumTemplate->output();
                }
            }
            
            if($pagesTpl == '') {
                $this->pagenumTemplate->repeat($pagesN);
                
                for($i=1; $i<=$pagesN; $i++)
                    $this->pagenumTemplate->set('num', $i, $i);
            
                $pagesTpl = $this->pagenumTemplate->output();
            }
        } else {
            for($i=1; $i<=$pagesN; $i++)
                $pagesTpl .= $i . ' ';
        }
        
        $recordsTpl = '';
        if(isset($this->recordTemplate) && is_a($this->recordTemplate, 'Template') ) {
            $this->recordTemplate->repeat($recordsN);
            
            $recId = 1;
            foreach($records as $record) {
                $this->recordTemplate->setData($record, $recId);
                $recId++;
            }
            
            $recordsTpl = $this->recordTemplate->output();
        }
        
        $this->template->set('records', $recordsTpl);
        $this->template->set('pages', $pagesTpl);
        
        return $this->template->output();
    }
}

?>