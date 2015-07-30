<?php

class HomepageModel extends WebpageModel {
    private $articles;
    
    public function __construct() {
        $articleModel = new ArticleModel;
        $this->articles = new ArticlesView($articleModel);
    }
    
    public function getArticles() {
        return $this->articles->output();
    }
}

?>