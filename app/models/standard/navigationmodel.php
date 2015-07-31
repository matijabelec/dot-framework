<?php

class NavigationModel extends ComplexModel {
    public function __construct() {
        parent::__construct();
        
        $nav1 = new Model;
        $this->assignModel('item1', $nav1);
        
        $nav2 = new Model;
        $this->assignModel('item2', $nav2);
        
        $nav3 = new Model;
        $this->assignModel('item3', $nav3);
    }
}

?>