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
        print_r($this->db);
        
        $records = $this->db->query('SELECT * FROM articles_view');
        foreach($records as $record)
            echo '<pre>' . print_r($record, 1) . '</pre>';
        return $records;
    }
}

?>