<?php

class Database {
    private static $instance;
    private $storage;
    
    private static $dbc;
    
    protected $registry;
    
    public function __construct() {
        $this->registry = Registry::getInstance();
        
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
    
    public function __set($key, $val) {
        $this->storage[$key] = $val;
    }
    
    public function __get($key) {
        if(isset($this->storage[$key]) ) {
            return $this->storage[$key];
        }
        throw new Exception('Database has no data with key "' . $key . '".');
    }
    
    protected function connect() {
        self::$dbc->charset = $this->charset;
        self::$dbc->hostname = $this->hostname;
        self::$dbc->database = $this->database;
        self::$dbc->username = $this->username;
        self::$dbc->password = $this->password;
        self::$dbc->connect();
    }
    
    protected function disconnect() {
        self::$dbc->disconnect();
    }
    
    public function query($sql, $args=[]) {
        return self::$dbc->query($sql, $args);
    }
    
    public function update($sql, $args=[]) {
        return self::$dbc->update($sql, $args);
    }
}

?>