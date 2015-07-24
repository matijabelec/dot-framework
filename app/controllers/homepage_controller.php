<?php

class Homepage_controller extends Controller {
    public function index($args=null) {
        echo 'homepage->index';
        if(!is_null($args) ) {
            echo '(';
            foreach($args as $arg) {
                echo ' ' . $arg;
            }
            echo ' )';
        }
    }
    
    public function index2($args=null) {
        echo 'homepage->index2';
        if(!is_null($args) ) {
            echo '(';
            foreach($args as $arg) {
                echo ' ' . $arg;
            }
            echo ' )';
        }
    }
}

?>