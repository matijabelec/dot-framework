<?php

/**
 * name: Loader
 * 
 * desc: used to load any resource file
 * 
 */
class Loader {
    /* load template file 
     * @ret:
     *      if file exists:
     *          file_content
     *      else:
     *          null
     */
    public function get_template($template_name) {
        $filename = ROOT_TEMPLATES . '/' . $template_name . 'php';
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
    public function get_langfile($langfile_name) {
        $filename = ROOT_LANGS . '/' . $langfile_name . 'php';
        if(file_exists($filename) ) {
            return file_get_contents($filename);
        }
        return null;
    }
    
    /* load controller 
     * @ret:
     *      if loaded:
     *          true
     *      else:
     *          false
     */
    public static function load_controller($controller_name) {
        $filename = ROOT_CONTROLLERS . '/' . $controller_name . 'php';
        if(file_exists($filename) ) {
            include_once($filename);
            return true;
        }
        return false;
    }
    
    /* load model 
     * @ret:
     *      if loaded:
     *          true
     *      else:
     *          false
     */
    public static function load_model($model_name) {
        $filename = ROOT_MODELS . '/' . $model_name . 'php';
        if(file_exists($filename) ) {
            include_once($filename);
            return true;
        }
        return false;
    }
    
    /* load view 
     * @ret:
     *      if loaded:
     *          true
     *      else:
     *          false
     */
    public static function load_view($view_name) {
        $filename = ROOT_VIEWS . '/' . $view_name . 'php';
        if(file_exists($filename) ) {
            include_once($filename);
            return true;
        }
        return false;
    }
    
    /* load module 
     * @ret:
     *      if loaded:
     *          true
     *      else:
     *          false
     */
     public static function load_view($module_name) {
        $filename = ROOT_MODULES . '/' . $module_name . 'php';
        if(file_exists($filename) ) {
            include_once($filename);
            return true;
        }
        return false;
    }
}

?>