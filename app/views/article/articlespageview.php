<?php

class ArticlesPageView extends WebpageView {
    public function __construct($model) {
        $view = new ArticlesView($model);
        
        $template = new Template('{@articles}', 
                                array('articles'=>$view->output() ), 
                                true);
        
        
        $pageModel = new WebpageModel;
        $pageModel->addRegion($template);
        
        parent::__construct($pageModel);
    }
}

?>