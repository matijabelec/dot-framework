<?php

class IndexModel extends BaseModel implements iListable {
    protected $page;
    
    public function setPage($page) {
        $this->db = Database::getInstance();
        $this->page = $page;
    }
    
    public function getPage() {
        return $this->page;
    }
    
    public function getData() {
        $records = $this->db->query('SELECT * FROM articles_view');
        foreach($records as $record)
            echo '<pre>' . print_r($record, 1) . '</pre>';
        return $records;
    }
}

?>