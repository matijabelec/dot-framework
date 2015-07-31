<?php

class ArticleController {
    private $model;
    
    public function __construct(ArticleModel &$model) {
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