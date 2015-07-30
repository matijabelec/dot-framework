<?php

class HomepageView extends WebpageView {
    public function __construct(HomepageModel $model) {
        $template = new Template('page/homepage');
        parent::__construct($model, $template);
    }
}

?>