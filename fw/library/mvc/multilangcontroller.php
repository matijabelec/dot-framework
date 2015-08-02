<?php

class MultilangBaseController extends BaseController {
    private $cookie;
    
    public function __construct() {
        parent::__construct();
        $this->cookie = Cookie::getInstance();
        
        if(is_null($this->cookie->get(DEFAULT_LANG_COOKIE_NAME) ) ) {
            $this->cookie->set(DEFAULT_LANG_COOKIE_NAME, DEFAULT_LANGUAGE, 86400, '/');
        }
        
        $this->registry->language = $this->cookie->get(DEFAULT_LANG_COOKIE_NAME);
    }
}

?>