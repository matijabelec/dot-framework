<?php

/**
 * Template class file
 * 
 * PHP version 5
 * 
 * LICENSE: 
 *
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */

/**
 * Class which represents template
 * 
 * It represents primarily html string which can have keys (in template set with {@key}) or includes (in 
 * template set as {#include(file)}).
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
class Template {
    
    /**
     * @var string
     * @access private
     */
    private $template;
    
    /**
     * @var array
     * @access private
     */
    private $storage;
    
    /**
     * @var Load
     * @access protected
     */
    protected $load;
    
    /**
     * Constructor for template has few important functionalities
     * 
     * It sets template string to private variable.
     * Prepares internal storage (an array in which all template keys with values will be inserted).
     * Also, prepares loader if template will need to load another template and loads recursively all 
     * templates which are set with option #include in template file automaticaly.
     * 
     * @param string $template represents template's string
     * @access public
     */
    public function __construct($template) {
        $this->template = $template;
        $this->storage = [];
        $this->load = new Load;
        
        /*
         * Load other templates in template. It merges multiple templates intoone template.
         */
        $this->processIncludes();
    }
    
    /**
     * Used to set value for key on template
     * 
     * @param string $key 
     * @param string $val 
     * @access public
     */
    public function __set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    /**
     * Used to get value of key, if key not set, NULL is returned
     * 
     * @param string $key 
     * @return mixed|null 
     * @access public
     */
    public function __get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
    
    /**
     * Used to set value for key on template
     * 
     * @param string $key 
     * @param string $val 
     * @access public
     */
    public function set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    /**
     * Used to get value of key, if key not set, NULL is returned
     * 
     * @param string $key 
     * @return mixed|null
     * @access public
     */
    public function get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
    
    /**
     * Used to fill template and return filled string to view
     * 
     * @param boolean $safe is used to set if keys which are not set remains visible or they are replaced 
     *                      with empty string (safe or unsafe)
     * @return string representing filled template
     * @access public
     */
    public function output($safe=true) {
        if($safe == true) {
            
            /*
             * This will return safe fill of template, this means that all keys which is not set will get 
             * an value of empty string.
             */
            return preg_replace_callback(
                '/\{\@([a-zA-Z0-9-\/]*)\}/i', //{@key}
                function($m) {
                    /*
                     * Check if key is set (key is $m[1]), if key is found then check if value is view or 
                     * string.
                     * If value is view then trigger view's output method (force view to render), or, if 
                     * value is string, just return value.
                     * If key is not found then $value will get value of empty string (this is standard 
                     * behaviour if $safe is set to true).
                     */
                    if(isset($this->storage[$m[1] ]) ) {
                        $value = is_a($this->storage[$m[1] ], 'BaseView') ? 
                                        $this->storage[$m[1] ]->output() : 
                                        $this->storage[$m[1] ];
                    } else {
                        $value = '';
                    }
                    return $value;
                },
                $this->template
            );
        } else {
            
            /*
             * This is used when template will be filled in some other place (or for debug purpose).
             * Any not-set keys will remain visible on filled template.
             */
            return preg_replace_callback(
                '/\{\@([a-zA-Z0-9-\/]*)\}/i', //{@key}
                function($m) {
                    
                    /*
                     * Check if key is set, if it is set, further check is needed.
                     * If value is view then force render of view (call view's method output to produce 
                     * rendered view).
                     * If value is not view then it is a string so value will be returned as is.
                     * There is third option: key is not set, in which case key remains same ($m[0] is 
                     * original key's string shown on original (not-filled) template).
                     */
                    if(isset($this->storage[$m[1] ]) ) {
                        $value = is_a($this->storage[$m[1] ], 'BaseView') ? 
                                        $this->storage[$m[1] ]->output() : 
                                        $this->storage[$m[1] ];
                    } else {
                        $value = $m[0];
                    }
                    return $value;
                },
                $this->template
            );
        }
    }
    
    /**
     * Used to include all tempaltes in original template (it is called on template's first load (in 
     * constructor only) )
     * 
     * @access private
     */
    private function processIncludes() {
        $this->template = preg_replace_callback(
            '/\{#include\(([a-zA-Z0-9-\/]*)\)\}/i', //{#include(region/nav)}
            function($matches) {
                
                /*
                 * If include found on template, recursive call to load template occurs.
                 * Template will be filled-in with $safe=false option; this is set to remain all keys 
                 * visible on template when template merges on current template.
                 */
                $value = $this->load->template($matches[1])->output(false);
                return $value;
            },
            $this->template
        );
    }
}

?>