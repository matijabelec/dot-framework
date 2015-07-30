<?php

class HomepageModel extends WebpageModel {
    private $articles;
    private $langData;
    
    public function __construct() {
        parent::__construct();
        
        $this->addData(Loader::getLangfile('page/homepage', 'en') );
        
        $articleModel = new ArticleModel;
        $this->articles = new ArticlesView($articleModel);
        $articles = $this->articles->output();
        $this->addValue('articles', $articles);
    }
}

?>