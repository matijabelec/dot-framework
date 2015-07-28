<?php

class Homepage_model extends Webpage_model {
    private $contentLeft = '';
    private $contentRight = '';
    private $contentMiddle = '';
    
    public function __construct() {
        $this->addCss('style');
        $this->addCss('style-col');
        
        
        $article = FrontController::index('article/random'); //CAMV
        $this->addToContentMiddle($article);
        $article = FrontController::index('article/random'); //CAMV
        $this->addToContentMiddle($article);
        $article = FrontController::index('article/random'); //CAMV
        $this->addToContentRight($article);
        
        
        $template = new Template('main/3-col');
        $template->set('content-left', $this->contentLeft);
        $template->set('content-middle', $this->contentMiddle);
        $template->set('content-right', $this->contentRight);
        $this->addRegion($template);
        
        $template = new Template('main/1-col');
        $template->set('content', $this->contentMiddle);
        $this->addRegion($template);
        
        $template = new Template('main/2-col');
        $template->set('content-left', $this->contentMiddle);
        $template->set('content-right', $this->contentRight);
        $this->addRegion($template);
    }
    
    public function getPageTitle() {
        return 'Homepage';
    }
    
    protected function addToContentLeft($content) {
        if(isset($content) && is_string($content) )
            $this->contentLeft .= $content;
    }
    protected function addToContentMiddle($content) {
        if(isset($content) && is_string($content) )
            $this->contentMiddle .= $content;
    }
    protected function addToContentRight($content) {
        if(isset($content) && is_string($content) )
            $this->contentRight .= $content;
    }
}

?>