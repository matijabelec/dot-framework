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
    private static $instance;
    private static $conn = null;
    protected $storage;
    
    private function __construct() {
        $this->charset = 'utf8';
        $this->hostname = DB_HOSTNAME;
        $this->database = DB_DATABASE;
        $this->username = DB_USERNAME;
        $this->password = DB_PASSWORD;
    }
    
    public static function getInstance() {
        if(!self::$instance instanceof self) {
            self::$instance = new DatabasePDOConnection;
        }
        return self::$instance;
    }
    
    public function __set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    public function __get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        return null;
    }
    
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
    
    public function disconnect() {
        self::$conn = null;
    }
    
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