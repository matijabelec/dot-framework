<?php

class ArticlesModel extends WebpageModel {
    private $articleModel;
    
    public function __construct() {
        $this->articleModel = new ArticleModel;
    }
    
    public function setPage($page) {
        $this->model->setPage($page);
    }
}

?>