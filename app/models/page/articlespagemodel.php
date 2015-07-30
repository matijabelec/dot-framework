<?php

class ArticlespageModel extends WebpageModel {
    private $articlesModel;
    private $articlesView;
    
    public function __construct() {
        $this->articlesModel = new ArticleModel;
        $this->articlesView = new ArticlesView($this->articlesModel);
    }
    
    public function getArticles() {
        return $this->articlesView->output();
    }
    
    public function setPage($page) {
        $this->articlesModel->setPage($page);
    }
}

?>