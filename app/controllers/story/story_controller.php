<?php

class Story_controller extends Controller {
    public function set_story_by_id($id) {
        if($this->model && isset($id) ) {
            $this->model->get_story_by_id($id);
        }
    }
    
    public function set_page($page) {
        if(is_numeric($page) && $page>0)
            $this->model->page = $page;
        else
            $this->model->page = 1;
    }
}

?>