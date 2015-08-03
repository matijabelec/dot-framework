<?php

/**
 * iPageable interface file
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
 * Interface for pageable model used in pageable view.
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
interface iPageable {
    
    /**
     * Returns records for current page.
     * 
     * @param integer $limit an limitation of records number
     * @param integer $offset an offset from beginning
     * @return array
     * @access public
     */
    public function getRecords($limit, $offset);
    
    /**
     * Returns number of all records that can be shown on pages.
     * 
     * @return integer
     * @access public
     */
    public function getRecordsMax();
    
    /**
     * Returns current's page number.
     * 
     * @return integer
     * @access public
     */
    public function getCurrentPage();
    
    /**
     * Returns number of records shown per page.
     * 
     * @return integer
     * @access public
     */
    public function getRecordsPerPage();
}

?>