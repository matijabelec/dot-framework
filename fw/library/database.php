<?php

/**
 * Database class used for DB access in Dot-framework
 *
 * Database class used for DB access in framework.
 *
 * PHP version 5
 *
 * LICENSE: 
 *
 * @author     Matija Belec <matijabelec1@gmail.com>
 * @copyright  2015 Matija Belec
 * @license    Proprietary
 */

/**
 * Database class used for interactions with database
 * 
 * It uses PDO connection handlers.
 */
class Database {
    /**
     * Database username
     *
     * String representing username.
     *
     * @var string
     * @access private
     * @static
     */
    private static $dbUsername = DFW_DB_USERNAME;
    
    /**
     * Database user password
     *
     * String representing user password.
     *
     * @var string
     * @access private
     * @static
     */
    private static $dbPassword = DFW_DB_PASSWORD;
    
    /**
     * Database name
     *
     * String representing database name.
     *
     * @var string
     * @access private
     * @static
     */
    private static $dbDatabase = DFW_DB_DATABASE;
    
    /**
     * Database hostname
     *
     * String representing hostname.
     *
     * @var string
     * @access private
     * @static
     */
    private static $dbHostname = DFW_DB_HOSTNAME;
    
    /**
     * Connection to database
     *
     * PDO connection.
     *
     * @var PDO
     * @access private
     * @static
     */
    private static $conn = null;
    
    /**
     * Private constructor because class is static
     * 
     * This private constructor prevents instantiation of this class.
     * 
     * @access private
     */
    private function __construct() {}
    
    /**
     * Returns connection to database
     * 
     * Method used to get a connection to database.
     * 
     * @param string    $arg1 an string representing database name
     * @param string    $arg2 an string representing username
     * @param string    $arg3 an string representing user's password
     * 
     * @return PDO connection.
     * @access public
     * @static
     */
    public static function connect($dbname=null, $user=null, $pw=null) {
        if(is_null(self::$conn) ) {
            $host = self::$dbHostname;
            $db = is_null($dbname) ? self::$dbDatabase : $dbname;
            $u = is_null($user) ? self::$dbUsername : $user;
            $p = is_null($pw) ? self::$dbPassword : $pw;
            
            try {
              self::$conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $u, $p);
            } catch(PDOException $pdoE) {
                die();//die($pdoE->getMessage() );
            }
        }
        return self::$conn;
    }
    
    /**
     * Disconnects from database
     * 
     * Method used to disconnect from database.
     * 
     * @access public
     * @static
     */
    public static function disconnect() {
        if(!is_null(self::$conn) )
            self::$conn = null;
    }
    
    /**
     * Returns result of query (select)
     * 
     * Method used to get result of query (select query).
     * 
     * @param string    $arg1 an string representing query
     * @param array    $arg2 an array representing key=>value pairs for
     *                  query string or NULL
     * 
     * @return array an array with pairs of key=>value or empty array
     * @access public
     * @static
     */
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
    
    /**
     * Returns result of query (update, insert, delete)
     * 
     * Method used to get result of query (update, insert, delete query).
     * It returns number of rows which is affected.
     * 
     * @param string    $arg1 an string representing query
     * @param array    $arg2 an array representing key=>value pairs for
     *                  query string or NULL
     * 
     * @return int an integer representing how many rows are affected
     * @access public
     * @static
     */
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