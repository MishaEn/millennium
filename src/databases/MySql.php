<?php

class MySql
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $host = getenv('DB_HOST');
        $db   = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWORD');
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
        ];

        $this->pdo = new PDO($dsn, $user, $pass, $options);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new MySql();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}