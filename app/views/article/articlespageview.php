<?php

class ArticlespageView extends WebpageView {
    public function __construct(ArticlespageModel $model) {
        $template = new Template('page/articlespage');
        parent::__construct($model, $template);
    }
}

?>