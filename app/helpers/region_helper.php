<?php

class Region_helper {
    public static function create($content=null) {
        $template = new Template('
<div class="region">{@content}</div>', null, true);
        
        if(isset($content) && !is_null($content) )
            $template->set('content', $content);
        
        return $template;
    }
}

?>