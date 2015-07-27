<?php

class Article_model implements iListable {
    private $id;
    
    public function set_id($id) {
        if(isset($id) && is_numeric($id) && $id>0)
            $this->id = $id;
    }
    
    public function get_records() {
        if(isset($this->id) ) {
            $article = Database::query('SELECT id, title, text FROM articles_view WHERE id=:id',
                                        array('id'=>$this->id) );
            
            if(count($article) == 1)
                return $article[0];
        }
        return array();
    }
}

?>