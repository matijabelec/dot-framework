<?php

class ArticleView {
    private $model;
    
    public function __construct(ArticleModel $model) {
        $this->model = $model;
    }
    
    public function output() {
        $article = $this->model->getData();
        
        if(isset($article['id']) 
        && isset($article['title']) 
        && isset($article['text']) ) {
            $template = new Template('article/article', array('ROOT' => WEB_ROOT,
                                                        'article-link' => 'article/view') );
            $template->setData($article);
            return $template->output();
        }
        
        return '<p>Article not found.</p>';
    }
}

?>