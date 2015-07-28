<?php

/* model */
interface iPageable {
    public function getPageRecords($limit, $offset);
    public function getPerPage();
    public function getCurrentPage();
    public function getRecordsMaxCount();
}


interface iListable {
    public function getRecords();
}


interface iWebpage {
    public function getData();
    public function loadLangData($langfile, $lang);
}


/* controller */
interface iSearchable {
    public function setCriteria($criteria);
}


interface iEditable {
    public function create();
    public function read();
    public function update();
    public function delete();
}

?>