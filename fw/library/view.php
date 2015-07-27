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
    /**
     * The model for view
     *
     * Possible values are: Model or null. Model is set in constructor.
     *
     * @var Model
     * @access private
     */
    private $model;
    
    /**
     * Constructor for view
     *
     * Constructor sets default model for view.
     * 
     * @param Model    $arg1 an model for view or null if no model required
     * 
     * @access public
     */
    public function __construct(Model &$model=null) {
        $this->model = $model;
    }
}

?>