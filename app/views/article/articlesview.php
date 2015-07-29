<?php

class ArticlesView extends PageableView {
    public function __construct(iPageable $model) {
        $template = new Template('<div>{@records}</div><p>{@pages}</p>', null, true);
        parent::__construct($model, $template);
        
        $this->recordTemplate = new Template('<div>
    <h3>{@id}: {@title}</h3>
    <p>{@text}</p>
</div>', null, true);
        
        $this->pagenumTemplate = new Template('<span> {@num} </span>', null, true);
        $this->currentPagenumTemplate = new Template('
<span class="selected"> [{@num}] </span>', null, true);
    }
}

?>