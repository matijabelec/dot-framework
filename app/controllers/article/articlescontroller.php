<?php

class ArticlesController {
    private $model;
    
    public function __construct(ArticleModel &$model) {
        $this->model = $model;
    }
    
    public function page($page) {
        $this->model->setPage($page);
    }
}

?>