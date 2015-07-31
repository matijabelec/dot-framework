<?php

class ComplexView extends View {
    private $model;
    private $template;
    
    private $viewsList = [];
    
    public function __construct(Model &$model, Template &$template) {
        parent::__construct($model, $template);
        $this->model = $model;
        $this->template = $template;
    }
    
    protected function assignView($name, View &$view) {
        if(isset($name) && isset($view) ) {
            $this->viewsList[$name] = $view;
            return true;
        }
        return false;
    }
    
    public function output() {
        // get all views rendered and set for a key in data
        $data = [];
        foreach($this->viewsList as $viewName=>&$view) {
            $data[$viewName] = $view->output();
        }
        
        // add data to template
        $this->template->setData($data);
        
        // render
        return $this->template->output(true);
    }
}

?>