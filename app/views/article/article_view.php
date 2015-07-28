<?php

class Article_view {
    private $model;
    
    public function __construct(Article_model $model) {
        $this->model = $model;
    }
    
    public function output() {
        $article = $this->model->getData();
        
        if(isset($article['id']) 
           && isset($article['title']) 
           && isset($article['text']) ) {
            return '<h2>' . $article['id'] . ': ' . $article['title'] . '</h2><p>' . $article['text'] . '</p>';
        }
        
        return '<p>Article not found.</p>';
    }
}

?>