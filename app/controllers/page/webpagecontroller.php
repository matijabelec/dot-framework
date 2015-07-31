<?php

class WebpageController {
    protected $model;
    
    public function __construct(Model $model) {
        $this->model = $model;
    }
    
    public function index() {}
}

?>