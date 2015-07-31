<?php

class ArticlesController extends Controller {
    private $model;
    
    public function __construct(ArticleModel &$model) {
        parent::__construct();
        $this->model = $model;
    }
    
    public function page($page) {
        $this->model->setPage($page);
    }
}

?>