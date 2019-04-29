<?php
final class DB extends PDO {
    private static $instance = null; 
    
    private function __construct() {
        include_once(MAIN . "/db_params.php"); 
        $dsn = "mysql:host=$db_params[host];dbname=$db_params[dbname];charset=$db_params[charset]"; 
        $opt = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC); 
        $pdo = parent::__construct($dsn, $db_params['user'], $db_params['password'], $opt); 
        return $pdo; 
    }
    
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance; 
    }
}
?>