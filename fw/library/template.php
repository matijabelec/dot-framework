<?php

/**
 * Template class used for templates in Dot-framework
 *
 * Template class used for templates in Dot-framework
 *
 * PHP version 5
 *
 * LICENSE: 
 *
 * @author     Matija Belec <matijabelec1@gmail.com>
 * @copyright  2015 Matija Belec
 * @license    Proprietary
 */

/**
 * An template class
 *
 * Template class is used for loading template files and it is used
 * in Dot-framework.
 */
class Template {
    private $template;
    private $data;
    private $n;
    private $curr_n;
    
    /**
     * Constructor for template
     * 
     * Set template string (load string from file) or set string inline.
     * 
     * @param string    $arg1 an string for name of template, or template 
     *                      string itself
     * @param bool    $arg2 if inline is set to false then name is template 
     *                      name, or, if inline is set to true, than name is
     *                      template string
     * 
     * @access public
     */
    public function __construct($name, $inline=false) {
        $this->template = '';
        
        if(isset($name) ) {
            if($inline != false) {
                $this->template = $name;
            } else {
                $this->template = Loader::get_template($name);
            }
            if(isset($this->template) ) {
                $this->process_hardcode_includes();
            }
        }
        
        $this->data = array();
        
        $this->n = 1;
    }
    
    /**
     * Sets value for key
     * 
     * Set value for key. If template repetition is set (with method repeat
     * then third argument is used to determine for which template in 
     * repeatition sets key)
     * 
     * @param string    $arg1 an string which is used to determine a key on 
     *                      template
     * @param string    $arg2 an string which is used as value which is 
     *                      filled in where key is on template located
     * @param int    $arg3 an integer which identifies template number if 
     *                  method repeat is used
     * 
     * @access public
     */
    public function set($key, $val, $arr_id=1) {
        if(isset($key) && isset($val) ) {
            $a = &$this->data[$arr_id];
            $a[$key] = array('type'=>'value', 'value'=>$val);
        }
    }
    
    /**
     * Sets data (multiple values and keys) in template
     * 
     * Set multiple values for multiple keys in one function call. Array
     * must be like: array([key=>val] [, key2=>val2] [, ...]).
     * 
     * @param array    $arg1 an array which includes all key=>value pairs
     * @param int    $arg3 an integer which identifies template number if 
     *                  method repeat is used
     * 
     * @access public
     */
    public function set_data($data, $arr_id=1) {
        if(isset($data) && is_array($data) ) {
            foreach($data as $key=>$val) {
                $a = &$this->data[$arr_id];
                $a[$key] = array('type'=>'value', 'value'=>$val);
            }
        }
    }
    
    /**
     * Set number of repeatition of current template on method output call
     * 
     * On method output call class will create n copies of template
     * 
     * @param int    $arg1 an integer of how many templates will be created.
     * 
     * @access public
     */
    public function repeat($n) {
        if(isset($n) && is_numeric($n) && $n>0) {
            $this->n = $n;
        }
    }
    
    /**
     * Returns filled data
     * 
     * Method output fills n copies of template and returns filled template string
     * 
     * @param bool    $arg1 an true/false value. if true than all {@key} found
     *                      in template but not in data will be replaced with
     *                      empty string or, if false, key will be left intact
     * 
     * @return string the filled template.
     * @access public
     */
    public function output($safe=true) {
        $string = $this->template;
        $pattern = '/\{\@([a-zA-Z0-9-\/]*)\}/i'; //{@key}
        
        if($safe == true) {
            $filled = preg_replace_callback(
                $pattern,
                function($matches) {
                    $value = $this->filled_data($matches[1]);
                    if(is_null($value) ) {
                        return '';
                    }
                    return $value;
                },
                $string
            );
            for($i=2; $i<=$this->n; $i++) {
                $this->curr_n = $i;
                $filled .= preg_replace_callback(
                    $pattern,
                    function($matches) {
                        $value = $this->filled_data($matches[1], $this->curr_n);
                        if(is_null($value) ) {
                            return '';
                        }
                        return $value;
                    },
                    $string
                );
            }
        } else {
            $filled = preg_replace_callback(
                $pattern,
                function($matches) {
                    $value = $this->filled_data($matches[1]);
                    if(is_null($value) ) {
                        $v = $matches[0];
                        return $v;
                    }
                    return $value;
                },
                $string
            );
            for($i=2; $i<=$this->n; $i++) {
                $this->curr_n = $i;
                $filled .= preg_replace_callback(
                    $pattern,
                    function($matches) {
                        $value = $this->filled_data($matches[1], $this->curr_n);
                        if(is_null($value) ) {
                            return '';
                        }
                        return $value;
                    },
                    $string
                );
            }
        }
        
        return $filled;
    }
    
    /**
     * Adds new template as value for key in template
     * 
     * This method adds new template in this template which is then saved as
     * value for key
     * 
     * @param string    $arg1 an key in template
     * @param Template    $arg2 an template which is set as value
     * @param int    $arg3 used if repeat() function is called to set template
     *                  on n-th template in copies
     * 
     * @return string the filled template.
     * @access public
     */
    public function include_template($key, Template &$template, $arr_id=1) {
        if(isset($key) && isset($template) ) {
            $a = &$this->data[$arr_id];
            $a[$key] = array('type'=>'template', 'template'=>&$template);
        }
    }
    
    /**
     * Method used in constructor for hardcode load of templates in template
     * 
     * Method searches for all includes in original template on load of 
     * template. Includes in template is set as {#include(name)} where 'name'
     * is a template's name.
     * 
     * @access private
     */
    private function process_hardcode_includes() {
        $string = $this->template;
        $pattern = '/\{#include\(([a-zA-Z0-9-\/]*)\)\}/i'; //{#include(region/nav)}
        $this->template = preg_replace_callback(
            $pattern,
            function($matches) {
                $value = $matches[1];
                if(is_null($value) )
                    return '';
                $tpl = new Template($value);
                return $tpl->output();
            },
            $string
        );
    }
    
    /**
     * Method returns value for key
     * 
     * Method used for retriveing of value for chosen key.
     * 
     * @param string    $arg1 an key in template
     * @param int    $arg2 used if repeat() function is called to set template
     *                  on n-th template in copies
     * 
     * @return string the value of key (if template then template returns output).
     *                      returns NULL if key not exists
     * @access private
     */
    private function filled_data($key, $arr_id=1) {
        if(isset($key) && isset($this->data[$arr_id]) ) {
            $a = &$this->data[$arr_id];
            if(isset($a[$key]) ) {
                $item = &$a[$key];
                switch($item['type']) {
                    case 'value': return $item['value'];
                    case 'template': return $item['template']->output();
                    default: break;
                }
            }
        }
        return null;
    }
    
    /**
     * Method returns template if value of key is template or returns null
     * 
     * Method used for retriveing of value for chosen key. It returns
     * template or null.
     * 
     * @param string    $arg1 an key in template
     * @param int    $arg2 used if repeat() function is called to get value
     *                  on n-th template in copies
     * 
     * @return &mixed the value of key if template (returns &Template). Else,
     *                  returns null.
     * @access public
     */
    public function &get_template($key, $arr_id=1) {
        if(isset($key) && isset($this->data[$arr_id]) ) {
            $a = &$this->data[$arr_id];
            if(isset($a[$key]) ) {
                $item = &$a[$key];
                switch($item['type']) {
                    case 'template': return $item['template'];
                    default: break;
                }
            }
        }
        global $null_guard;
        return $null_guard;
    }
}

?>