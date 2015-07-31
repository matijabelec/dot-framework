<?php

class NavigationView extends ComplexView {
    private $model;
    
    public function __construct(ComplexModel &$model, Template &$template=null) {
        $template = new Template('<nav><ul>{@main-menu}</ul></nav>', null, true);
        $this->model = $model;
        parent::__construct($this->model, $template);
        
        $itemTpl = new Template('<li><a href="{@link}">{@name}</a></li>', null, true);
        
        $item1 = $this->model->getModel('menu');
        if(!is_null($item1) ) {
            $view = new MenuView($item1, $itemTpl);
            $this->assignView('main-menu', $view);
        }
    }
}

?>