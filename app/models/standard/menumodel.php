<?php

class MenuModel extends Model {
    private $items;
    
    public function __construct($data) {
        parent::__construct();
        if(isset($data) && is_array($data) )
            foreach($data as &$item)
                $this->items[] = ['name'=>$item[0], 'link'=>$item[1] ];
    }
    
    public function getData() {
        return $this->items;
    }
}

?>