<?php

class ArticlespageModel extends WebpageModel {
    private $articlesModel;
    private $articlesView;
    
    public function __construct() {
        parent::__construct();
        $this->addData(Loader::getLangfile('page/articlespage', 'en') );
        
        $this->articlesModel = new ArticleModel;
        $this->articlesView = new ArticlesView($this->articlesModel);
    }
    
    public function setPage($page) {
        $this->articlesModel->setPage($page);
    }
    
    public function getData() {
        parent::addValue('articles', $this->articlesView->output() );
        return parent::getData();
    }
}

?>