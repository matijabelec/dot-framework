<?php

class MenuView extends View {
    private $model;
    private $template;
    
    public function __construct(MenuModel &$model, Template &$template) {
        parent::__construct($model, $template);
        $this->model = $model;
        $this->template = $template;
    }
    
    public function output() {
        $data = $this->model->getData();
        $dataN = (is_array($data) ? count($data) : 0);
        if($dataN > 0) {
            $this->template->repeat($dataN);
            for($i=1; $i<=$dataN; $i++)
                $this->template->setData($data[$i-1], $i);
        }
        return $this->template->output();
    }
}

?>