<?php

class ComplexModel extends Model {
    private $modelsList;
    
    public function __construct() {
        parent::__construct();
        $this->modelsList = [];
    }
    
    protected function assignModel($name, Model &$model) {
        if(isset($name) && isset($model) ) {
            $this->modelsList[$name] = $model;
            return true;
        }
        return false;
    }
    
    public function &getModel($name) {
        if(isset($name) && isset($this->modelsList[$name]) ) {
            return $this->modelsList[$name];
        }
        global $nullGuard;
        return $nullGuard;
    }
}

?>