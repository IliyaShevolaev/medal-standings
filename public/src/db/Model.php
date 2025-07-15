<?php

require_once __DIR__ . '/DatabaseConnection.php';

class Model
{
    private $tableName;
    private $dbConnection;
    private $fields;

    public function __construct(string $tableName, array $fields)
    {
        $this->tableName = $tableName;
        $this->dbConnection = DatabaseConnection::getInstance();
        $this->fields = $fields;
    }

    public function all(): array
    {
        $result = $this->dbConnection->makeQuery('SELECT * FROM ' . $this->tableName);

        $resultArray = [];

        while ($row = $result->fetch_assoc()) {
            $record = [];

            foreach ($this->fields as $field) {
                $record[$field] = $row[$field];
            }

            $resultArray[] = $record;
        }

        return $resultArray;
    }

    public function insert(array $values): void
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