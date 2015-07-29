<?php

/**
 * Template class used for templates in Dot-framework
 *
 * Template class used for templates in framework.
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
    /**
     * The string which represents template
     *
     * It set from constructor.
     *
     * @var string
     * @access private
     */
    private $template;
    
    /**
     * The array of data used to fill template
     *
     * All data which is set in this var is used in method output() to
     * fill in a template string.
     *
     * @var array
     * @access private
     */
    private $data;
    
    /**
     * The number of copies of template used
     *
     * It can have value in range from 1 to N. It is set to 1 if method 
     * repeat is not used or to N if it is used.
     *
     * @var int
     * @access private
     */
    private $n;
    
    /**
     * The current id_number of template used in processing
     *
     * It is used when processing an template if template has more copies.
     *
     * @var int
     * @access private
     */
    private $currN;
    
    /**
     * Constructor for template
     * 
     * Set template string (load string from file) or set string inline.
     * Template data can be sent on construct. Data is sent as an array of 
     * key=>value pairs: array([key=>value] [ , key=>value] [, ...]) and
     * it can be used with values that are string.
     * 
     * @param string    $arg1 an string for name of template, or template 
     *                      string itself
     * @param array    $arg2 an data which is set on template load
     * @param bool    $arg3 if inline is set to false then name is template 
     *                      name, or, if inline is set to true, than name is
     *                      template string
     * 
     * @access public
     */
    public function __construct($name, $defaultData=null, $inline=false) {
        $this->template = '';
        $this->data = array();
        $this->n = 1;
        
        if(isset($name) ) {
            if($inline != false) {
                $this->template = $name;
            } else {
                $this->template = Loader::getTemplate($name);
            }
            if(isset($this->template) ) {
                //$this->process_hardcode_includes();
                
                $string = $this->template;
                $pattern = '/\{#include\(([a-zA-Z0-9-\/]*)\)\}/i'; //{#include(region/nav)}
                $this->template = preg_replace_callback(
                    $pattern,
                    function($matches) {
                        $value = $matches[1];
                        $key = 'tpl-' . $value;
                        
                        $tpl = new Template($value);
                        $this->includeTemplate($key, $tpl);
                        return '{@' . $key . '}';
                    },
                    $string
                );
            }
            
            if(!is_null($defaultData) && is_array($defaultData) )
                foreach($defaultData as $key=>$val)
                    $this->set($key, $val);
        }
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
    public function set($key, $val, $tplN=0) {
        if(isset($key) && isset($val) ) {
            $a = &$this->data[$tplN];
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
    public function setData($data, $tplN=0) {
        if(isset($data) && is_array($data) ) {
            foreach($data as $key=>$val) {
                $a = &$this->data[$tplN];
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
        if(isset($n) && is_numeric($n) && $n>0)
            $this->n = $n;
    }
    
    /**
     * Returns filled data
     * 
     * Method output fills n copies of template and returns filled template string
     * 
     * @param bool    $arg1 an true/false value. If true then all {@key} found
     *                      in template but not in data will be replaced with
     *                      empty string or, if false, key will be left intact
     * @param bool    $arg2 an true/false value. If true then template is baked
     *                      two times (first time only keys are replaced, second
     *                      keys in values are replaced). Use this argument when
     *                      values contains keys
     * 
     * @return string the filled template.
     * @access public
     */
    public function output($safe=true) {
        $string = $this->template;
        $pattern = '/\{\@([a-zA-Z0-9-\/]*)\}/i'; //{@key}
        $filled = '';
        
        for($i=1; $i<=$this->n; $i++) {
            $this->currN = $i;
            $filled .= preg_replace_callback(
                $pattern,
                ($safe == true ?
                    function($matches) {
                        $value = $this->filledData($matches[1], $this->currN);
                        if(is_null($value) ) {
                            return '';
                        }
                        return $value;
                    } : 
                    function($matches) {
                        $value = $this->filledData($matches[1], $this->currN);
                        if(is_null($value) ) {
                            $v = $matches[0];
                            return $v;
                        }
                        return $value;
                    }
                ),
                $string
            );
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
    public function includeTemplate($key, Template &$template, $tplN=0) {
        if(isset($key) && isset($template) ) {
            $a = &$this->data[$tplN];
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
    private function processHardcodeIncludes() {
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
    private function filledData($key, $tplN=0) {
        if(isset($key) && isset($this->data[$tplN]) && isset($this->data[$tplN][$key]) ) {
            $item = &$this->data[$tplN][$key];
        } else if(isset($key) && isset($this->data[0]) && isset($this->data[0][$key]) ) {
            $item = &$this->data[0][$key];
        }
        if(isset($item) ) {
            switch($item['type']) {
                case 'value': return $item['value'];
                case 'template': return $item['template']->output(true);
                default: break;
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
    public function &getTemplate($key, $tplN=0) {
        if(isset($key) && isset($this->data[$tplN]) ) {
            $a = &$this->data[$tplN];
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
    
    /**
     * Method returns value of key or returns null
     * 
     * Method used for retriveing of value for chosen key. It returns
     * string or null.
     * 
     * @param string    $arg1 an key in template
     * @param int    $arg2 used if repeat() function is called to get value
     *                  on n-th template in copies
     * 
     * @return mixed the value of key if template (returns &Template). Else,
     *                  returns null.
     * @access public
     */
    public function &getValue($key, $tplN=0) {
        if(isset($key) && isset($this->data[$tplN]) ) {
            $a = &$this->data[$tplN];
            if(isset($a[$key]) ) {
                $item = &$a[$key];
                switch($item['type']) {
                    case 'value': return $item['value'];
                    default: break;
                }
            }
        }
        global $null_guard;
        return $null_guard;
    }
}

?>