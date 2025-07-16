<?php

require_once __DIR__ . '/DatabaseConnection.php';

class Model
{
    private $tableName;
    private $dbConnection;
    private $fields;

    private function fetchData(string $query): array
    {
        $result = $this->dbConnection->makeQuery($query);
        $resultArray = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $record = [];
                foreach ($this->fields as $field) {
                    if (array_key_exists($field, $row)) {
                        $record[$field] = $row[$field];
                    }
                }
                $resultArray[] = $record;
            }
        }

        return $resultArray;
    }

    public function __construct(string $tableName, array $fields)
    {
        $this->tableName = $tableName;
        $this->dbConnection = DatabaseConnection::getInstance();
        $this->fields = $fields;
    }

    public function all(): array
    {
        return $this->fetchData('SELECT * FROM ' . $this->tableName);
    }


    public function insert(array $values): int
    {   
        $fieldNamesArray = [];
        
        foreach ($this->fields as $field) {
            if ($field !== 'id') { 
                $fieldNamesArray[] = $field;
            }
        }
        
        $fielsNameString = ' (' . implode(', ', $fieldNamesArray) . ')';

        $valuesString = ' (';

        $valuesString .= implode(', ', $values) . ')';

        $this->dbConnection->makeQuery(
            'INSERT INTO ' . 
            $this->tableName . 
            $fielsNameString . 
            ' VALUES ' .
            $valuesString
        );

        return $this->dbConnection->getLastInsertId();
    }

    public function where(string $query): array 
    {
         return $this->fetchData(
            'SELECT * FROM ' . 
            $this->tableName . 
            ' WHERE ' . 
            $query
        );
    }

    public function delete(int $id): void 
    {
        $this->dbConnection->makeQuery(
            'DELETE FROM ' . 
            $this->tableName . 
            ' WHERE ' . 
            'id = ' .
            $id
        );
    }
}