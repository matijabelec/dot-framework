<?php

class WebpageController {
    protected $model;
    
    public function __construct(WebpageModel $model) {
        $this->model = $model;
    }
    
    public function index() {}
}

?>