<?php

class IndexController extends BaseController {
    public function indexAction() {
        $model = $this->load->model('index');
        $model->setPage(1);
        
        
        $lview = $this->load->view('listable');
        $lview->model = $model;
        $lview->template = $this->load->template('test');
        
        
        $view = $this->load->view('index');
        $view->template = $this->load->template('test-2');
        $view->template->viewer1 = $lview;
        
        
        echo $view->render();
    }
    
    public function langAction($arg) {
        $translate = Translate::getInstance();
        
        $id = 1;
        if(isset($arg[0]) && is_numeric($arg[0]) )
            $id = $arg[0];
        
        $string = $translate->byId(['title'=>$id]);
        print_r($string);
        
        echo '<br>';
        
        $string = $translate->byId($id);
        print_r($string);
    }
}

?>