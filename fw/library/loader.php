<?php

/**
 * name: Loader
 * 
 * desc: used to load any resource file
 * 
 */

class Loader {
    /*************************/
    /*** getters *************/
    /*************************/
    /* load template file 
     * @ret:
     *      if file exists:
     *          file_content
     *      else:
     *          null
     */
    public static function getTemplate($templateName) {
        if(!isset($templateName) )
            return null;
        $filename = ROOT_TEMPLATES . '/' . $templateName . '.tpl';
        if(file_exists($filename) ) {
            return file_get_contents($filename);
        }
        return null;
    }
    
    /* load lang file 
     * @ret:
     *      if file exists:
     *          file_content
     *      else:
     *          null
     */
    public static function getLangfile($langfileName, $lang) {
        if(!isset($langfileName) || !isset($lang) )
            return null;
        $filename = ROOT_LANGS . '/' . $langfileName . '.lang';
        if(file_exists($filename) ) {
            $ret = array();
            $xml = simplexml_load_file($filename);
            foreach($xml->children() as $child) {
                    $id = $child->attributes();
                    $id = (string)$id->id;
                    $v = '?';
                    $first = true;
                    foreach($child as $key => $value) {
                        $l = $value->attributes();
                        if($l == $lang) {
                            $v = (string)$value;
                            break;
                        }
                        if($first) {
                            $v = (string)$value;
                            $first = false;
                        }
                    }
                    $ret[$id] = $v;
            }
            return $ret;
        }
        return null;
    }
    
    /* load module 
     * @ret:
     *      if loaded:
     *          true
     *      else:
     *          false
     */
     public static function load_module($moduleName) {
        if(!isset($moduleName) )
            return false;
        $filename = ROOT_MODULES . '/' . $moduleName . '.php';
        if(file_exists($filename) ) {
            include_once($filename);
            return true;
        }
        return false;
    }
}

?>