<?php

/**
 * Database class file
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
 * Class used to work with database
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
class Database {
    
    /**
     * @var array
     * @access private
     */
    private $storage;
    
    /**
     * @var DatabasePDOConnection
     * @access private
     * @static
     */
    private static $dbc;
    
    /**
     * Constructor used to set default values
     * 
     * @access public
     */
    public function __construct() {
        $this->charset = 'utf8';
        $this->hostname = DB_HOSTNAME;
        $this->database = DB_DATABASE;
        $this->username = DB_USERNAME;
        $this->password = DB_PASSWORD;
        
        self::$dbc = DatabasePDOConnection::getInstance();
        self::$dbc->charset = $this->charset;
        self::$dbc->hostname = $this->hostname;
        self::$dbc->database = $this->database;
        self::$dbc->username = $this->username;
        self::$dbc->password = $this->password;
    }
    
    /**
     * Used to set properties
     * 
     * @param string $key 
     * @param mixed $val 
     * @access public
     */
    public function __set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    /**
     * Used to get value of property
     * 
     * @param string $key 
     * @return mixed|null 
     * @access public
     */
    public function __get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
    
    /**
     * Used to connect to database
     * 
     * @return PDOConnection or exception if PDOException occured
     * @access public 
     */
    public function connect() {
        self::$dbc->charset = $this->charset;
        self::$dbc->hostname = $this->hostname;
        self::$dbc->database = $this->database;
        self::$dbc->username = $this->username;
        self::$dbc->password = $this->password;
        return self::$dbc->connect();
    }
    
    /**
     * Used to disconnect from database
     * 
     * @access public 
     */
    public function disconnect() {
        self::$dbc->disconnect();
    }
    
    /**
     * Used to run a query on database
     * 
     * @param string $sql representing query 
     * @param array $args representing list of arguments
     * @return array an array which represents returned data from query
     * @access public
     */
    public function query($sql, $args=[]) {
        return self::$dbc->query($sql, $args);
    }
    
    /**
     * Used to run a query on database
     * 
     * @param string $sql representing query 
     * @param array $args representing list of arguments
     * @return integer represents number of modified rows
     * @access public
     */
    public function update($sql, $args=[]) {
        return self::$dbc->update($sql, $args);
    }
}

?>