<?php

class ListableView extends BaseView {
    public function output() {
        if(isset($this->model) || !($this->model instanceof iListable) ) {
            throw new Exception('Model is not of type "iListable".' . 
                                ' File: ' . __FILE__ . 
                                ' line: ' . __LINE__);
        }
        if(isset($this->template) || !($this->template instanceof Template) ) {
            throw new Exception('Template is not of type "Template".' . 
                                ' File: ' . __FILE__ . 
                                ' line: ' . __LINE__);
        }
        
        $data = $this->model->getData();
        $dataN = count($data);
        
        $filled = '';
        for($i=0; $i<$dataN; $i++) {
            foreach($data[$i] as $key=>&$val)
                $this->template->set($key, $val);
            $filled .= $this->template->output();
        }
        return $filled;
    }
}

?>