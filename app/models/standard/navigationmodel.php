<?php

class NavigationModel extends ComplexModel {
    public function __construct() {
        parent::__construct();
        
        $menu = new MenuModel([ ['Home', WEB_ROOT.'/'],
                                ['Projects', WEB_ROOT.'/projects'],
                                ['About', WEB_ROOT.'/about'] ]);
        $this->assignModel('menu', $menu);
    }
}

?>