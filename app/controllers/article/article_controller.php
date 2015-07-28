<?php

class Article_controller {
    private $model;
    
    public function __construct(Article_model $model) {
        $this->model = $model;
    }
    
    public function view($id) {
        $this->model->setId($id);
    }
    
    public function random() {
        $this->model->setRandomId();
    }
}

?>