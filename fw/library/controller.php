<?php

class Controller {
    public $model = null;
    public $view = null;
    
    public function __construct($model=null, $view=null) {
        $this->model = $model;
        $this->view = $view;
    }
}

?>