<?php

/**
 * iListable interface file
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
 * Interface for listable model used in listable view.
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
interface iListable {
    
    /**
     * Returns all records from list.
     * 
     * @return array
     * @access public
     */
    public function getData();
}

?>