<?php

class Database {
    private static $db_username = DFW_DB_USERNAME;
    private static $db_password = DFW_DB_PASSWORD;
    private static $db_database = DFW_DB_DATABASE;
    private static $db_hostname = DFW_DB_HOSTNAME;
    private static $conn = null;
    
    public static function connect($dbname=null, $user=null, $pw=null) {
        if(is_null(self::$conn) ) {
            $host = self::$db_hostname;
            $db = is_null($dbname) ? self::$db_database : $dbname;
            $u = is_null($user) ? self::$db_username : $user;
            $p = is_null($pw) ? self::$db_password : $pw;
            
            try {
              self::$conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $u, $p);
            } catch(PDOException $pdo_e) {
                die($pdo_e->getMessage() );
            }
        }
        return self::$conn;
    }
    
    public static function disconnect() {
        if(!is_null(self::$conn) )
            self::$conn = null;
    }
    
    public static function query($sql, $args=null) {
        if(is_null($args) || !is_array($args) )
            $args = array();
        
        $db = self::connect();
        
        $st = $db->prepare($sql);
        $st->execute($args);
        $res = $st->fetchAll(PDO::FETCH_ASSOC);
        
        self::disconnect();
        
        return $res;
    }
    
    public static function update($sql, $args=null) {
        if(is_null($args) || !is_array($args) )
            $args = array();
        
        $db = self::connect();
        
        $st = $db->prepare($sql);
        $st->execute($args);
        $rowcnt = $st->rowCount();
        
        self::disconnect();
        
        return $rowcnt;
    }
}

?>