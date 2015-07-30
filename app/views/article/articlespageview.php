<?php

class ArticlespageView extends WebpageView {
    public function __construct(ArticlespageModel $model) {
        $template = new Template('page/articlespage');
        parent::__construct($model, $template);
    }
    
    public function output() {
        $data = $this->model->getArticles();
        $this->template->set('articles', $data);
        return parent::output();
    }
}

?>