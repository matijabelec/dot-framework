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
    public static function get_template($template_name) {
        if(!isset($template_name) )
            return null;
        $filename = ROOT_TEMPLATES . '/' . $template_name . '.tpl';
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
    public static function get_langfile($langfile_name, $lang) {
        if(!isset($langfile_name) || !isset($lang) )
            return null;
        $filename = ROOT_LANGS . '/' . $langfile_name . '.lang';
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
     public static function load_module($module_name) {
        $filename = ROOT_MODULES . '/' . $module_name . '.php';
        if(file_exists($filename) ) {
            include_once($filename);
            return true;
        }
        return false;
    }
}

?>