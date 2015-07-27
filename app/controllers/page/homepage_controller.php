<?php

class Homepage_controller extends Controller {
    public function index() {
        $lang = Lang_controller::get();
        $page = '';
        
        
        $header = new Header_controller($lang);
        switch($lang) {
            case 'hr':
                $header->set_title('Početna');
                break;
            default:
                $header->set_title('Homepage');
        }
        $header->add_css('style');
        $header->add_css('style-article');
        $page .= $header->output();
        
        
        $page .= (new Navigation_controller($lang) )->output();
        
        
        $article = new Article_controller;
        $article->set_criteria(4);
        $page .= $article->output();
        
        
        $page .= (new Footer_controller($lang) )->output();
        
        
        echo $page;
    }
}

?>