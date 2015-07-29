<?php

class StandardpageView extends WebpageView {
    public function __construct(WebpageModel $model, Template $template) {
        $tplH = new Template('standard/header');
        $tplN = new Template('standard/nav');
        $tplF = new Template('standard/footer');
        
        $tpl = $tplH->output(false);
        $tpl .= $tplN->output(false);
        $tpl .= '{@main-content}';
        $tpl .= $tplF->output(false);
        
        $data = array(
                    'ROOT' => WEB_ROOT,
                    'SITE' => WEB_SITE
        );
        $pageTpl = new Template($tpl, $data, true);
        parent::__construct($model, $pageTpl);
        
        $this->bodyTemplate = $template;
    }
}

?>