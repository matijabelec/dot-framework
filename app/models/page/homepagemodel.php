<?php

class HomepageModel extends WebpageModel {
    public function __construct() {
        parent::__construct();
        
        $this->addData(Loader::getLangfile('page/homepage', 'en') );
        
        $articleModel = new ArticleModel;
        $articlesView = new ArticlesView($articleModel);
        $this->addValue('articles', $articlesView->output() );
        
        $navModel = new NavModel;
        $navTemplate = new Template('standard/nav');
        $navTemplate->set('ROOT', WEB_ROOT);
        $navTemplate->set('SITE', WEB_SITE);
        $navTemplate->set('NAV-RET-LINK', '/');
        $navView= new NavView($navModel, $navTemplate);
        $this->addValue('NAV', $navView->output() );
    }
}

?>