<?php

interface iPageable {
    /**
     * Returns records for current page.
     * 
     * @return array
     * @public
     */
    public function getRecords();
    
    /**
     * Returns number of all records that can be
     * shown on pages.
     * 
     * @return integer
     * @public
     */
    public function getRecordsMax();
    
    /**
     * Returns current's page number.
     * 
     * @return integer
     * @public
     */
    public function getCurrentPage();
    
    /**
     * Returns number of records shown per page.
     * 
     * @return integer
     * @public
     */
    public function getRecordsPerPage();
}

?>