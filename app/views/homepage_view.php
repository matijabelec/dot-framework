<?php

class Homepage_view extends View {
    private $article;
    private $lang;
    
    public function __construct($article, $lang) {
        $this->article = $article;
        $this->lang = $lang;
    }
    
    public function output() {
        $template = new Template('page/2-col');
        $template->set('content-left', $this->article);
        
        $model = new Homepage_model($this->lang);
        
        $view = new Webpage_view($model, $template);
        return $view->output();
    }
}

?>