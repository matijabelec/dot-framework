<?php

class Story_model extends Model implements iListable, iPageable {
    const CRITERIA_SELECT_BY_ID = 'sel';
    
    private $page;
    private $query;
    
    public function set_criteria($type, $data=null) {
        if(isset($type) ) {
            switch($type) {
                case 'sel':
                    if(isset($data) && !is_null($data) && is_array($data) && isset($data['id']) ) {
                        $this->query = array(
                            'sql' => 'SELECT id, title, text FROM articles_view WHERE id=:id',
                            'args' => array('id'=>$data['id']) );
                    }
                    break;
                default:
                    break;
            }
        }
    }
    
    public function get_item() {
        if(isset($this->query) ) {
            $res = Database::query($this->query['sql'], $this->query['args']);
            if(count($res) ) {
                return $res[0];
            }
        }
        return null;
    }
    
    
    public function get_pages_count() {
        $n = $this->get_results_number();
        $pp = $this->get_items_per_page();
        return ceil($n/$pp);
    }
    public function get_current_page_items_count() {
        $pp = $this->get_items_per_page();
        $cp = $this->get_current_page();
        $items = $this->get_items($pp, ($cp-1)*$pp);
        $cnt = count($items);
        return $cnt;
    }
    
    
    
    public function set_page($page) {
        if(is_numeric($page) && $page>0)
            $this->page = $page;
        else
            $this->page = 1;
    }
    
    
    /*public function get_item() {
        if(isset($this->data) )
            return $this->data;
        else
            return null;
    }*/
    
    
    public function get_items($limit, $offset) {
        $res = Database::query('SELECT id, title, text FROM articles_view ORDER BY id ASC LIMIT ' . $limit . ' OFFSET ' . $offset,
                                array() );
        return $res;
    }
    public function get_items_per_page() {
        return 5;
    }
    public function get_current_page() {
        if(isset($this->page) )
            return $this->page;
        return 1;
    }
    public function get_results_number() {
        $res = Database::query('SELECT count(*) as "cnt" FROM articles_view');
        return $res[0]['cnt'];
    }
}

?>