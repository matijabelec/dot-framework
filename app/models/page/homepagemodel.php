<?php

class HomepageModel extends WebpageModel {
    private $contentLeft = '';
    private $contentRight = '';
    private $contentMiddle = '';
    
    public function __construct() {
        $this->addCss('style');
        $this->addCss('style-col');
        $this->addCss('style-article');
        
        $article = FrontController::index('article/random');
        $this->addToContentRight($article);
        
        
        $tplL = new Template('main/2-col');
        $tplL->set('content-left', '<p>xx-testL</p>');
        $tplL->set('content-right', '<p>xx-testR</p>
<p>xx-testR</p>
<p>xx-testR</p>
<p>xx-testR</p>
<p>xx-testR</p>
<p>xx-testR</p>
<p>xx-testR</p>
<p>xx-testR</p>
<p>xx-testR</p>
<p>xx-testR</p>
<p>xx-testR</p>
<p>xx-testR</p>
<p>xx-testR</p>
<p>xx-testR</p>
<p>xx-testR</p>
');
        
        $tplM = new Template('main/3-col');
        $tplM->set('content-left', '<p>testL</p>');
        $tplM->set('content-middle', '<p>testM</p>');
        $tplM->set('content-right', '<p>testR</p>');
        
        $template = new Template('main/3-col');
        $template->set('content-left', $tplL->output() );
        $template->set('content-middle', $tplM->output() );
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