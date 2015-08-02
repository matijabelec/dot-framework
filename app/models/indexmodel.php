<?php

class IndexModel extends BaseModel implements iListable {
    protected $page;
    
    public function setPage($page) {
        $this->db = new Database;
        $this->page = $page;
    }
    
    public function getPage() {
        return $this->page;
    }
    
    public function getData() {
        $records = $this->db->query('SELECT * FROM articles_view');
        return $records;
    }
}

?>