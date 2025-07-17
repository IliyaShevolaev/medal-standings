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

    private function prepare(string $query, array $params): bool|mysqli_stmt
    {
        $stmt = $this->connection->prepare($query);

        if (!empty($params)) {
            $stmt->bind_param($params['types'], ...$params['values']);
        }

        return $stmt;
    }

    public static function getInstance(): DatabaseConnection
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function makeQuery(string $query, array $params): mysqli_result|bool
    {
        if (empty($params)) {
            return $this->connection->query($query);
        }

        $stmt = $this->prepare($query, $params);
        $stmt->execute();

        if (str_starts_with(trim($query), 'SELECT')) {
            return $stmt->get_result();
        }

        return $stmt->affected_rows > 0;
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