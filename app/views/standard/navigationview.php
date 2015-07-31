<?php

class NavigationView extends ComplexView {
    private $model;
    
    public function __construct(ComplexModel &$model, Template &$template=null) {
        $template = new Template('<nav><ul>{@menu}</ul></nav>', null, true);
        $this->model = $model;
        parent::__construct($this->model, $template);
        
        $itemTpl = new Template('<li></li>', null, true);
        
        $item1 = $this->model->getModel('item1');
        if(!is_null($model) ) {
            $view = new View($item1, $itemTpl);
            $this->assignView('menu', $view);
        }
        /*
        $view = new ListableView();
        $this->assignView('home', $view);*/
    }
}

?>