<?php

class Template {
    private $template;
    private $data;
    private $n;
    private $currN;
    
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
    
    public function set($key, $val, $tplN=0) {
        if(isset($key) && isset($val) ) {
            $a = &$this->data[$tplN];
            $a[$key] = array('type'=>'value', 'value'=>$val);
        }
    }
    
    public function setData($data, $tplN=0) {
        if(isset($data) && is_array($data) ) {
            foreach($data as $key=>$val) {
                $a = &$this->data[$tplN];
                $a[$key] = array('type'=>'value', 'value'=>$val);
            }
        }
    }
    
    public function repeat($n) {
        if(isset($n) && is_numeric($n) && $n>0)
            $this->n = $n;
    }
    
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
    
    public function includeTemplate($key, Template &$template, $tplN=0) {
        if(isset($key) && isset($template) ) {
            $a = &$this->data[$tplN];
            $a[$key] = array('type'=>'template', 'template'=>&$template);
        }
    }
    
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
}

?>