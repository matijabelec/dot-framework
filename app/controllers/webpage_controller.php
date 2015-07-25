<?php

class Webpage_controller extends Controller {
    public function add_css() {
        
    }
    
    public function add_js() {
        
    }
    
    public function add_data($key, $val) {
        if($this->model) {
            $this->model->add_data($key, $val);
        }
    }
    
    protected function show_webpage($page_mdl, $content) {
        $page_ctrl = new Webpage_controller($page_mdl);
        $page_ctrl->add_data('content', $content);
        
        $page_tpl = new Template('page');
        $page_view = new Webpage_view($page_mdl, $page_tpl);
        echo $page_view->show();
    }
}

?>