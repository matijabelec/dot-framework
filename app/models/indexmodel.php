<?php

class IndexModel extends BaseModel {
    protected $page;
    
    public function setPage($page) {
        $this->page = $page;
    }
    
    public function getPage() {
        return $this->page;
    }
}

?>