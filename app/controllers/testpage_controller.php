<?php

class Testpage_controller extends Controller {
    private $model;
    
    public function __construct($model) {
        $this->model = $model;
    }
    
    public function index() {
        $articles = new Articles_list;
        
        $body = new Template('main/3-col');
        $body->set('content-middle', $articles->render() );
        
        $this->model->setBody($body);
    }
}

?>