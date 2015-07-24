<?php

class Story_controller extends Controller {
    public function set_story_by_id($id) {
        if($this->model && isset($id) ) {
            $this->model->get_story_by_id($id);
        }
    }
}

?>