<?php

class Story_model extends Model implements Pageable {
    public $title = '';
    public $desc = '';
    
    public $page = 1;
    
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
    
    
    
    public function get_items($limit, $offset) {
        $data = array(array('title'=>'Title1', 'text'=>'Description1'),
                      array('title'=>'Title2', 'text'=>'Description2'),
                      array('title'=>'Title3', 'text'=>'Description3'),
                      array('title'=>'Title4', 'text'=>'Description4'),
                      array('title'=>'Title5', 'text'=>'Description5'),
                      array('title'=>'Title6', 'text'=>'Description6'),
                      array('title'=>'Title7', 'text'=>'Description7'),
                      array('title'=>'Title8', 'text'=>'Description8'),
                      array('title'=>'Title9', 'text'=>'Description9'),
                      array('title'=>'Title10', 'text'=>'Description10'),
                      array('title'=>'Title11', 'text'=>'Description11'),
                      );
        $ret = array();
        
        $i = $offset;
        $k = $offset+$limit;
        if($i>=0 && $k<count($data) ) {
        for(; $i<$k; $i++)
            $ret[] = $data[$i];
        }
        return $ret;
    }
    public function get_items_per_page() {
        return 3;
    }
    public function get_current_page() {
        return $this->page;
    }
    public function get_results_number() {
        return 11;
    }
}

?>