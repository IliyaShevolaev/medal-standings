<?php

class DatabaseConnection
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $connection;
    private static $instance;

    private function __construct()
    {
        $config = require_once __DIR__ . '/../config/database.php';
        
        $this->connection = new mysqli(
            $config['host'],
            $config['username'],
            $config['password'],
            $config['dbname']
        );

        if ($this->connection->connect_error) {
            die("DB error: " . $this->connection->connect_error);
        }
    }

    public static function getInstance(): DatabaseConnection
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function makeQuery(string $query): mysqli_result | bool
    {
        return $this->connection->query($query);
    }

    public function getLastInsertId(): int
    {
        return mysqli_insert_id($this->connection);
    }

    public function closeConnetction(): void
    {
        $this->connection->close();
    }
}