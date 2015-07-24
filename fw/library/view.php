<?php

class View {
    public $model;
    
    public function __construct(Model $model) {
        $this->model = $model;
    }
}

?>