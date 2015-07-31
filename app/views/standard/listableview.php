<?php

class ListableView extends View {
    private $model;
    private $template;
    
    public function __construct(iListable &$model, Template &$template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function output() {
        // get data
        $data = $this->model->getRecords();
        $dataN = (is_array($data) ? count($data) : 0);
        
        // if there is data then fill template with data
        if($dataN > 0) {
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