<?php

class HomepageView extends WebpageView {
    public function __construct(HomepageModel $model) {
        $template = new Template('page/homepage');
        parent::__construct($model, $template);
    }
    
    public function output() {
        $data = $this->model->getArticles();
        $this->template->set('articles', $data);
        return parent::output();
    }
}

?>