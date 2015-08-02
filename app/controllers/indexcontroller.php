<?php

class IndexController extends BaseController {
    public function indexAction() {
        $this->model = $this->load->model('index');
        $this->model->setPage(1);
        
        $this->view = $this->load->view('index');
        $this->view->model = $this->model;
        $this->view->template = $this->load->template('test');
        echo $this->view->output();
        
        $this->lview = $this->load->view('listable');
        $this->lview->model = $this->model;
        $this->lview->template = $this->load->template('test');
        echo $this->lview->output();
    }
}

?>