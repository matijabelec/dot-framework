<?php

class ArticlesView extends PageableView {
    public function __construct(iPageable $model) {
        $template = new Template('<div>{@records}</div><p>{@pages}</p>', null, true);
        parent::__construct($model, $template);
        
        
        $articleLink = WEB_ROOT . '/article/view/';
        
        $this->recordTemplate = new Template('<div>
    <h3><a href="' . $articleLink . '{@id}">{@title}</a></h3>
    <p>{@text}</p>
</div>', null, true);
        
        
        $articlesPageLink = WEB_ROOT . '/articles/page/';
        
        $this->pagenumTemplate = new Template('
<a href="' . $articlesPageLink . '{@num}">{@num}</a>', null, true);
        $this->currentPagenumTemplate = new Template('
<a class="selected" href="' . $articlesPageLink . '{@num}">[{@num}]</a>', null, true);
    }
}

?>