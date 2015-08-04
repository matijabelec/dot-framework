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
    
    public function langAction($id=1, $key='test') {
        $translate = Translate::getInstance();
        
        if(!is_numeric($id) )
            $id = 1;
        
        $string = $translate->byId(['title'=>$id]);
        print_r($string);
        
        echo '<br>';
        
        $string = $translate->byId($id);
        print_r($string);
        
        
        
        echo '<br>';
        
        $string = $translate->byKey([$key]);
        print_r($string);
        
        echo '<br>';
        
        $string = $translate->byKey($key);
        print_r($string);
    }
    
    public function translateAction() {
        $translate = Translate::getInstance();
        $itemId = $translate->addKey('title-123');
        if($itemId) {
            $translate->addTranslationById($itemId, 'en', 'Title');
            $translate->addTranslationByKey('title-123', 'hr', 'Naslov');
            
            echo 'translation added';
        } else {
            echo 'translation error';
        }
    }
}

?>