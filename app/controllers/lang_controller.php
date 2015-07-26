<?php

class Lang_controller extends Controller {
    public function set($lang) {
        if(isset($lang) ) {
            switch($lang) {
                case 'en': 
                case 'hr': 
                    Session::set('lang', $lang);
                    //if(isset())
                    //Redirect($redir_url);
                    return STATUS_OK;
                    break;
                default:
                    break;
            }
        }
        return STATUS_ERR;
    }
    public static function get() {
        $lang = Session::get('lang');
        if(is_null($lang) ) {
            Session::set('lang', DEFAULT_LANG);
            $lang = DEFAULT_LANG;
        }
        return $lang;
    }
}

?>