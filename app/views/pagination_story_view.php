<?php

class Pagination_story_view extends View {
    private $view;
    
    public function __construct(iPageable $model) {
        $template = new Template('pagination');
        $tpl = new Template('story/story_mini');
        $tpl2 = new Template(' <a {@curr-num} href="{@ROOT}/test/pagination/{@num}">{@num}</a> ', null, true);
        
        $template->include_template('items', $tpl);
        $template->include_template('pages', $tpl2);
        $template->set('page-current', 'class="selected"');
        $template->set('ROOT', WEB_ROOT);
        $template->set('SITE', WEB_SITE);
        $template->set('story-link', '/test/region');
        
        $this->view = new Pagination_view($model, $template);
    }
    
    public function output() {
        return $this->view->output();
    }
}

?>