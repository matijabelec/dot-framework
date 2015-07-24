<?php

class Template {
    protected $data = '';
    protected $filled_data = '';
    
    /* 
     * values:
     *        key => value:string
     *        key => array(view_name:string,
     *                     values:array)
     */
    protected $values = array();
    
    protected function process_includes() {
        $string = $this->data;
        $pattern = '/\{#include\(([a-zA-Z0-9-\/]*)\)\}/i'; /*{#include(region/nav)}*/
        $this->data = preg_replace_callback(
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
    
    public function __construct($name, $inline=false) {
        if($inline != false) {
            $this->data = $name;
        } else {
            $this->data = Loader::get_template($name);
        }
        
        $this->filled_data = $this->data;
        
        if(!is_null($this->data) ) {
            $this->process_includes();
        }
    }
    
    public function set($key, $value) {
        $this->values[$key] = $value;
    }
    
    public function set_data($data) {
        if(isset($data) && is_array($data) )
            foreach($data as $k=>$v)
                $this->values[$k] = $v;
    }
    
    public function get($key) {
        if(isset($this->values[$key]) )
            return $this->values[$key];
        return null;
    }
    
    public function fill() {
        $string = $this->data;
        $pattern = '/\{\@([a-zA-Z0-9-]*)\}/i'; /*{@key}*/
        $this->filled_data = preg_replace_callback(
            $pattern,
            function($matches) {
                $value = $this->get($matches[1]);
                if(is_null($value) )
                    return '';
                return $value;
            },
            $string
        );
    }
    
    public function output() {
        return $this->filled_data;
    }
}

?>