<?php

/**
 * DatabasePDOConnection class file
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
 * Class used to work with database with PDO
 * 
 * @author      Matija Belec <matijabelec1@gmail.com>
 * @copyright   2015 Matija Belec
 * @license     
 */
class DatabasePDOConnection {
    
    /**
     * @var DatabasePDOConnection
     * @access private
     * @static
     */
    private static $instance;
    
    /**
     * @var PDOConnection|null
     * @access private
     * @static
     */
    private static $conn = null;
    
    /**
     * @var array
     * @access private
     */
    private $storage;
    
    /**
     * Constructor is private. Class is singleton
     * 
     * @access private
     */
    private function __construct() {
        $this->charset = 'utf8';
        $this->hostname = DB_HOSTNAME;
        $this->database = DB_DATABASE;
        $this->username = DB_USERNAME;
        $this->password = DB_PASSWORD;
    }
    
    /**
     * Used to get an instance of class
     * 
     * @return DatabasePDOConnection
     * @access public
     * @static
     */
    public static function getInstance() {
        if(!self::$instance instanceof self) {
            self::$instance = new DatabasePDOConnection;
        }
        return self::$instance;
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
        if(is_null(self::$conn) ) {
            try {
                self::$conn = new PDO(  "mysql:host={$this->hostname};" . 
                                        "dbname={$this->database};" . 
                                        "charset={$this->charset}",
                                        $this->username,
                                        $this->password);
            } catch(PDOException $pdoE) {
                throw new Exception($pdoE->getMessage() );
            }
        }
        return self::$conn;
    }
    
    /**
     * Used to disconnect from database
     * 
     * @access public
     */
    public function disconnect() {
        self::$conn = null;
    }
    
    /**
     * Used to run a query on database
     * 
     * @param string $sql representing query 
     * @param array $args representing list of arguments
     * @return array an array which represents returned data from query or exception if sql or args not valid
     * @access public
     */
    public function query($sql, $args=[]) {
        if(!isset($sql) )
            throw new Exception('Database query requires sql to be set.');
        
        if(!is_array($args) )
            throw new Exception('Database query requires sql arguments to be an array.');
        
        $db = $this->connect();
        $st = $db->prepare($sql);
        $st->execute($args);
        $res = $st->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        
        return $res;
    }
    
    /**
     * Used to run a query on database
     * 
     * @param string $sql representing query 
     * @param array $args representing list of arguments
     * @return integer represents number of modified rows or exception if sql or args not valid
     * @access public
     */
    public function update($sql, $args=[]) {
        if(!isset($sql) )
            throw new Exception('Database query(update) requires sql to be set.');
        
        if(!is_array($args) )
            throw new Exception('Database query(update) requires sql arguments to be an array.');
        
        $db = $this->connect();
        $st = $db->prepare($sql);
        $st->execute($args);
        $rowCount = $st->rowCount();
        $this->disconnect();
        
        return $rowCount;
    }
}

?>