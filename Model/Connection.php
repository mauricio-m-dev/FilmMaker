<?php

namespace Model;

use PDO;
use PDOException;

require_once __DIR__ . '/../config/configuration.php';

class Connection
{
    private static $connection;
    
    public static function getConnection()
    {
        if(empty(self::$connection)) {
            try {
                self::$connection = new PDO (
                    'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . '', DB_USER, DB_PASSWORD
                );
            } catch (PDOException $error) {
                die("Erro de conexão: " . $error->getMessage())
            }
        }
        return self::$connection;
    }
}
?>