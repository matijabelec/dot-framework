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
            return '
<div class="article-container">
    <h2 class="title">' . $article['id'] . ': ' . $article['title'] . '</h2>
    <p class="text">' . $article['text'] . '</p>
</div>';
        }
        
        return '<p>Article not found.</p>';
    }
}

?>