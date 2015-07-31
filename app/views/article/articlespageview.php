<?php

class ArticlespageView extends PageableView {
    public function __construct(ArticleModel &$model) {
        $template = new Template('
<div>
    <h2><a href="'.WEB_ROOT.'/article/view/{@id}">{@title}</a></h2>
    <p>{@text}</p>
</div>', null, true);
        
        parent::__construct($model, $template);
    }
}

?>