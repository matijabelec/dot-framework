<?php

class ArticlesListView extends ListableView {
    public function __construct(iListable &$model) {
        $template = new Template('
<div>
    <h2><a href="'.WEB_ROOT.'/article/view/{@id}">{@title}</a></h2>
    <p>{@text}</p>
</div>', null, true);
        
        parent::__construct($model, $template);
    }
}

/*
        
        

        $template = new Template('
<div>
    <h4>{@title} (<a href="/article/{@id}">link</a>)</h4>
    <p>{@text}</p>
</div>', null, true);
        
        
        $template = new Template('
<div>
    <h5>{@title} - #{@id}</h5>
    <p>{@text}</p>
</div>', null, true);
        
        $template = new Template('
<div>
    <span>{@id}) {@title}: </span>
    <span>{@text}</span>
</div>', null, true);
        
        
        
        
        
*/


?>