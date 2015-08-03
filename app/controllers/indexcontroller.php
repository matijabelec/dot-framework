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
}

?>