<?php

class IndexController extends MultilangBaseController {
    public function indexAction() {
        $model = $this->load->model('index');
        $model->setPage(1);
        
        
        $lview = $this->load->view('listable');
        $lview->model = $model;
        $lview->template = $this->load->template('test');
        
        
        $view = $this->load->view('index');
        $view->template = $this->load->template('test-2');
        $view->template->viewer1 = $lview;
        
        $page = $view->output();
        
        echo $page;
    }
}

?>