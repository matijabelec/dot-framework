<?php

class View {
    protected $model;
    
    public function __construct(Model $model) {
        $this->model = $model;
    }
}

?>