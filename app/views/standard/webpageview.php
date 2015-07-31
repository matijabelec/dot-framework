<?php

class WebpageView extends View {
    private $model;
    private $template;
    
    private $viewsArray;
    
    public function __construct(WebpageModel $model, Template $template=null) {
        $this->model = $model;
        $this->template = $template;
        $this->viewsArray = array();
    }
    
    public function assignView($name, View $view) {
        if(isset($name) && isset($view) ) {
            // add view for key in template
            $this->viewsArray[$name] = $view;
        }
    }
    
    public function output() {
        // get all default data for template
        $data = $this->model->getTemplateData();
        
        // get all views rendered and set for a key in data
        foreach($this->viewsArray as $viewName=>$view)
            $data[$viewName] = $view->output();
        
        // add data to template
        $this->template->setData($data);
        
        // render
        return $this->template->output(true);
    }
}

?>