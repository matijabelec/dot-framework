<?php

class IndexModel extends BaseModel implements iListable {
    protected $page;
    
    public function setPage($page) {
        $this->page = $page;
    }
    
    public function getPage() {
        return $this->page;
    }
    
    public function getData() {
        return [ ['name'=>'abc', 'tekst'=>'AbC'],
                 ['name'=>'def', 'tekst'=>'dEf'] ];
    }
}

?>