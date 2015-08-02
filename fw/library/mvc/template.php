<?php

class Template {
    private $template;
    private $storage;
    
    protected $load;
    
    public function __construct($template) {
        $this->template = $template;
        $this->storage = [];
        $this->load = new Load;
        
        /* load other templates in template */
        $this->processIncludes();
    }
    
    public function __set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    public function __get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
    
    public function set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    public function get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
    
    public function output($safe=true) {
        if($safe == true) {
            return preg_replace_callback(
                '/\{\@([a-zA-Z0-9-\/]*)\}/i', //{@key}
                function($m) {
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
            return preg_replace_callback(
                '/\{\@([a-zA-Z0-9-\/]*)\}/i', //{@key}
                function($m) {
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
    
    private function processIncludes() {
        $this->template = preg_replace_callback(
            '/\{#include\(([a-zA-Z0-9-\/]*)\)\}/i', //{#include(region/nav)}
            function($matches) {
                $value = $this->load->template($matches[1])->output(false);
                return $value;
            },
            $this->template
        );
    }
}

?>