<?php

class ListableView extends BaseView {
    public function output() {
        $this->checkInstance($this->model, 'iListable');
        $this->checkInstance($this->template, 'Template');
        
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