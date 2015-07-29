<?php

class HomepageView extends StandardpageView {
    public function __construct(HomepageModel $model) {
        $template = new Template('<div><h2>Homepage</h2></div>', null, true);
        parent::__construct($model, $template);
    }
}

?>