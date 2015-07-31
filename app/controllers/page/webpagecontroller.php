<?php

class WebpageController extends Controller {
    protected $model;
    
    public function __construct(Model $model) {
        parent::__construct();
        $this->model = $model;
    }
    
    public function index() {}
}

?>