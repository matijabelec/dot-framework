<?php

class ArticleController extends Controller {
    private $model;
    
    public function __construct(ArticleModel &$model) {
        parent::__construct();
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