<?php

class Story_model extends Model {
    public $title = '';
    public $desc = '';
    
    public function get_story_by_id($id) {
        if($id == 1) {
            $this->title = 'Story 1';
            $this->desc = 'Description of first story.';
        } else if($id == 2) {
            $this->title = 'Second story';
            $this->desc = 'This is second story. Take a look.';
        } else {
            $this->title = '';
            $this->desc = '';
        }
    }
}

?>