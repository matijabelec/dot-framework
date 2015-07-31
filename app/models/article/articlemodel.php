<?php

class ArticleModel extends Model implements iPageable, iListable {
    private $id;
    
    public function __construct() {
        parent::__construct();
    }
    
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
    
    
    public function getRecords() {
        $articles = Database::query('SELECT id, title, text FROM articles_view');
        return $articles;
    }
    
    
    
    private $page = 0;
    private $perPage = 5;
    public function setPage($page) {
        if(isset($page) && is_numeric($page) && $page>=0)
            $this->page = $page;
    }
    public function getPageRecords($limit, $offset) {
        $articles = Database::query('SELECT id, title, text FROM articles_view LIMIT ' . $limit . ' OFFSET ' . $offset);
        return $articles;
    }
    public function getPerPage() {
        return $this->perPage;
    }
    public function getCurrentPage() {
        return $this->page;
    }
    public function getRecordsMaxCount() {
        $cnt = Database::query('SELECT count(*) AS cnt FROM articles_view');
        if(count($cnt) == 1)
            return $cnt[0]['cnt'];
        return 0;
    }
}

?>