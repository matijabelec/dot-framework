<?php

class Widget implements iRenderable {
    private $template;
    
    public function __construct($model, $view) {
        
    }
    
    public function render() {
        return $this->template->output();
    }
}

?>