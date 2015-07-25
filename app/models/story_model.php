<?php

class Story_model extends Model implements Pageable {
    public $data;
    
    public $page = 1;
    
    public function get_story_by_id($id) {
        $res = Database::query('SELECT id, title, text FROM articles_view WHERE id=:id',
                                array('id'=>$id) );
                                
        if(count($res) ) {
            $this->data = $res[0];
        }
    }
    
    
    
    public function get_data() {
        if(isset($this->data) )
            return $this->data;
        else
            return null;
    }
    
    
    
    public function get_items($limit, $offset) {
        $res = Database::query('SELECT id, title, text FROM articles_view ORDER BY id ASC LIMIT ' . $limit . ' OFFSET ' . $offset,
                                array() );
        
        
        return $res;
    }
    public function get_items_per_page() {
        return 5;
    }
    public function get_current_page() {
        return $this->page;
    }
    public function get_results_number() {
        $res = Database::query('SELECT count(*) as "cnt" FROM articles_view');
        return $res[0]['cnt'];
    }
}

?>