<?php

class Region_story_view {
    private $view;
    
    public function __construct(iListable $model) {
        $template = new Template('
<div class="region">
{@content}
</div>', null, true);
        $template_item = new Template('story/story_full');
        $template->include_template('content', $template_item);
        
        $this->view = new Region_view($model, $template);
    }
    
    public function output() {
        return $this->view->output();
    }
}

?>