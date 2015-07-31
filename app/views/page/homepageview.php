<?php

class HomepageView extends ComplexView {
    public function __construct(ComplexModel $model) {
        $template = new Template('page/homepage', [ 'ROOT'=>WEB_ROOT,
                                                    'SITE'=>WEB_SITE]);
        parent::__construct($model, $template);
        
        $articlesModel = new ArticleModel;
        $view = new ArticlesListView($articlesModel);
        $this->assignView('articles', $view);
        
        $view2 = new ArticlesListView($articlesModel);
        $this->assignView('content-left', $view2);
        
        $view3 = new ArticlesListView($articlesModel);
        $this->assignView('content-mid', $view3);
    }
}

?>