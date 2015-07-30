<?php

class ArticlespageController extends WebpageController {
    public function __construct(ArticlespageModel $model) {
        parent::__construct($model);
    }
    
    public function page($page) {
        $this->model->setPage($page);
    }
}

?>