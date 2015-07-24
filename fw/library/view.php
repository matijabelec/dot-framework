<?php

class View {
    public $model;
    
    public function __construct(Model &$model=null) {
        $this->model = $model;
    }
}

?>