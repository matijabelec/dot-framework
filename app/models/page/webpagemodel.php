<?php

class WebpageModel {
    private $dataCss = '';
    private $dataMeta = '';
    private $regions = null;
    
    public function getData() {
        return array();
    }
    
    /*public function addRegion(Template $template, RegionModel $model=null) {
        if(is_null($model) )
            $model = new RegionModel;
        $this->regions[] = new RegionView($model, $template);
    }
    
    protected function addCss($filename, $inline=false) {
        if(isset($filename) && is_string($filename) ) {
            if($inline == false) {
                $this->dataCss .= 
                    '<link rel="stylesheet" href="'.SITE_CSS.'/'.$filename.'.css">';
            } else {
                $this->dataCss .= '<style>' . $filename . '</style>';
            }
        }
    }
    
    protected function addMeta($name, $content) {
        if(isset($name) && is_string($name) && isset($content) && is_string($content) ) {
            $this->dataMeta .= '<meta name="' . $name . '" content="' . $content . '">';
        }
    }
    protected function addMetaHttpEquiv($httpequiv, $content) {
        if(isset($httpequiv) && is_string($httpequiv) 
           && isset($content) && is_string($content) ) {
            $this->dataMeta .= '<meta http-equiv="' . $name . '" content="' . $content . '">';
        }
    }
    protected function addMetaCharset($charset='UTF-8') {
        if(isset($charset) && is_string($charset) ) {
            $this->dataMeta .= '<meta charset="' . $name . '">';
        }
    }*/
}

?>