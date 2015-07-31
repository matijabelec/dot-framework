<?php

/**
 * View class used for views in Dot-framework
 *
 * View class used for views in framework.
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
 * An default View class of Dot-framework
 *
 * View class is used for all views used in framework.
 */
class View {
    private $model;
    private $template;
    
    public function __construct(Model &$model, Template &$template) {
        $this->model = $model;
        $this->template = $template;
    }
    
    public function output() {
        $data = $this->model->getTemplateData();
        if(is_array($data) )
            $this->template->setData($data);
        return $this->template->output();
    }
}

?>