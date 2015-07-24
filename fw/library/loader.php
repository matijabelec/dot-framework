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
    public static function get_langfile($langfile_name) {
        $filename = ROOT_LANGS . '/' . $langfile_name . '.lang';
        if(file_exists($filename) ) {
            return file_get_contents($filename);
        }
        return null;
    }
    
    /* get controller 
     * @ret:
     *      if loaded:
     *          Controller
     *      else:
     *          null
     */
    public static function get_controller($controller_name, &$model) {
        $filename = ROOT_CONTROLLERS . '/' . $controller_name . '_controller.php';
        if(file_exists($filename) ) {
            include_once($filename);
            $e = explode('/', $controller_name);
            $c = ucfirst($e[count($e)-1].'_controller');
            return new $c($model);
        }
        return null;
    }
    
    /* get model 
     * @ret:
     *      if loaded:
     *          Model
     *      else:
     *          null
     */
    public static function get_model($model_name) {
        $filename = ROOT_MODELS . '/' . $model_name . '_model.php';
        if(file_exists($filename) ) {
            include_once($filename);
            $e = explode('/', $model_name);
            $m = ucfirst($e[count($e)-1].'_model');
            return new $m;
        }
        return null;
    }
    
    /* get view 
     * @ret:
     *      if loaded:
     *          View
     *      else:
     *          null
     */
    public static function get_view($view_name, &$model=null) {
        $filename = ROOT_VIEWS . '/' . $view_name . '_view.php';
        if(file_exists($filename) ) {
            include_once($filename);
            $e = explode('/', $view_name);
            $v = ucfirst($e[count($e)-1].'_view');
            return new $v($model);
        }
        return null;
    }
    
    /*************************/
    /*** loaders *************/
    /*************************/
    /* load controller 
     * @ret:
     *      if loaded:
     *          true
     *      else:
     *          false
     */
    public static function load_controller($controller_name) {
        $filename = ROOT_CONTROLLERS . '/' . $controller_name . '_controller.php';
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
        $filename = ROOT_MODELS . '/' . $model_name . '_model.php';
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
        $filename = ROOT_VIEWS . '/' . $view_name . '_view.php';
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