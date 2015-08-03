<?php

/**
 * Translate class file
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
 * Class which is used to translate strings to selected language
 * 
 * Class is singleton. 
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
class Translate {
    
    /**
     * @var Translate
     * @access private
     * @static
     */
    private static $instance;
    
    /**
     * @var Registry
     * @access protected
     */
    protected $registry;
    
    /**
     * @var Database
     * @access protected
     */
    protected $db;
    
    /**
     * @var string
     * @access protected
     */
    protected $failbackLanguage;
    
    /**
     * Constructor is private (class is singleton)
     * 
     * @access private
     */
    private function __construct() {
        $this->registry = Registry::getInstance();
        $this->db = new Database;
        $this->failbackLanguage = DEFAULT_LANGUAGE;
        
        /*
         * Check if language is set. Language must be set to work with Translate object.
         */
        if(is_null($this->registry->language) ) {
            throw new Exception('Translate class needs Registry->language to be set.');
        }
    }
    
    /**
     * Static method used to get an instance of Translate
     * 
     * @return Translate
     * @access public
     * @static
     */
    public static function getInstance() {
        if(!self::$instance instanceof self) {
            self::$instance = new Translate;
        }
        return self::$instance;
    }
    
    /**
     * Used to get translated value(s) for a id or array of ids
     * 
     * @param string|array $id an id or array of ids which strings will be translated
     * @param boolean $failBack if string on current language not found, try to translate to DEFAULT one, on 
     *                          failed to find (regardless of failback argument value) will return '?' as 
     *                          value for given string
     * @return string|array depending on which type is argument $id
     * @access public
     */
    public function byId($id, $failBack=true) {
        if(is_array($id) ) {
            $sql = 'SELECT * FROM `dfw_ml_values` WHERE id = :id AND lang = :lang';
            foreach($id as $k=>&$v) {
                $res = $this->db->query($sql, ['id'=>$v, 'lang'=>$this->registry->language]);
                if(count($res) == 1) {
                    $v = $res[0]['value'];
                } else {
                    if($failBack == false) {
                        $v = '?';
                    } else {
                        $res = $this->db->query($sql, ['id'=>$v, 'lang'=>$this->failbackLanguage]);
                        if(count($res) == 1) {
                            $v = $res[0]['value'];
                        } else {
                            $v = '?';
                        }
                    }
                }
            }
            return $id;
        } else if(is_string($id) || is_int($id) ) {
            $sql = 'SELECT * FROM `dfw_ml_values` WHERE id = :id AND lang = :lang';
            $res = $this->db->query($sql, ['id'=>$id, 'lang'=>$this->registry->language]);
            if(count($res) == 1) {
                return $res[0]['value'];
            } else {
                if($failBack == false) {
                    return '?';
                } else {
                    $res = $this->db->query($sql, ['id'=>$id, 'lang'=>$this->failbackLanguage]);
                    if(count($res) == 1) {
                        return $res[0]['value'];
                    } else {
                        return '?';
                    }
                }
            }
        }
    }
    
    /**
     * Used to get translated value(s) for a key or array of keys
     * 
     * @param string|array $key an key or array of keys which strings will be translated
     * @param boolean $failBack if string on current language not found, try to translate to DEFAULT one, on 
     *                          failed to find (regardless of failback argument value) will return '?' as 
     *                          value for given string
     * @return string|array depending on which type is argument $key
     * @access public
     */
    public function byKey($key, $failBack=true) {
        if(is_array($key) ) {
            $sql = 'SELECT * FROM `dfw_ml_values` WHERE `key` = :key AND `lang` = :lang';
            foreach($key as $k=>&$v) {
                $res = $this->db->query($sql, ['key'=>$v, 'lang'=>$this->registry->language]);
                if(count($res) == 1) {
                    $v = $res[0]['value'];
                } else {
                    if($failBack == false) {
                        $v = '?';
                    } else {
                        $res = $this->db->query($sql, ['key'=>$v, 'lang'=>$this->failbackLanguage]);
                        if(count($res) == 1) {
                            $v = $res[0]['value'];
                        } else {
                            $v = '?';
                        }
                    }
                }
            }
            return $key;
        } else if(is_string($key) ) {
            $sql = 'SELECT * FROM `dfw_ml_values` WHERE `key` = :key AND `lang` = :lang';
            $res = $this->db->query($sql, ['key'=>$key, 'lang'=>$this->registry->language]);
            if(count($res) == 1) {
                return $res[0]['value'];
            } else {
                if($failBack == false) {
                    return '?';
                } else {
                    $res = $this->db->query($sql, ['key'=>$key, 'lang'=>$this->failbackLanguage]);
                    if(count($res) == 1) {
                        return $res[0]['value'];
                    } else {
                        return '?';
                    }
                }
            }
        }
    }
}

?>