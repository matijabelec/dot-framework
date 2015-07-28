<?php

class Article_model {
    private $id;
    
    public function setId($id) {
        if(isset($id) && is_numeric($id) )
            $this->id = $id;
    }
    
    public function setRandomId() {
        $id = Database::query('SELECT count(*) AS id FROM articles_view');
        if(count($id) == 1)
            $this->id = mt_rand(1, $id[0]['id']);
    }
    
    public function getData() {
        $article = Database::query('SELECT id, title, text FROM articles_view WHERE id = :id',
                                    array('id'=>$this->id) );
        if(count($article) == 1)
            return $article[0];
        return array();
    }
}

?>