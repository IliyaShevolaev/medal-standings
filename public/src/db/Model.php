<?php

require_once __DIR__ . '/DatabaseConnection.php';

class Model
{
    private $tableName;
    private $dbConnection;
    private $fields;

    private function fetchData(string $query, $params = []): array
    {
        $result = $this->dbConnection->makeQuery($query, $params);
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

    private function escapeTags(string $value): string
    {
        return strip_tags($value, '<b><i><p><strong>');
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
        $fieldNames = [];
        $placeholders = [];

        foreach ($this->fields as $field) {
            if ($field != 'id') {
                $fieldNames[] = $field;
                $placeholders[] = '?';
            }
        }

        $fieldsString = ' (' . implode(', ', $fieldNames) . ')';
        $placeholdersString = ' (' . implode(', ', $placeholders) . ')';

        $query = 'INSERT INTO ' . $this->tableName . $fieldsString . ' VALUES ' . $placeholdersString;

        $types = '';
        $params = [];

        foreach ($values as $value) {
            if (is_int($value)) {
                $types .= 'i';
            } else if (is_string($value)) {
                $types .= 's';
                $value = $this->escapeTags($value);
            }

            $params[] = $value;
        }

        $this->dbConnection->makeQuery($query, [
            'types' => $types,
            'values' => $params
        ]);

        return $this->dbConnection->getLastInsertId();
    }

    public function where(string $query, array $params = []): array
    {
        return $this->fetchData(
            'SELECT * FROM ' .
            $this->tableName .
            ' WHERE ' .
            $query,
            $params
        );
    }

    public function delete(int $id, $params = []): void
    {
        $this->dbConnection->makeQuery(
            'DELETE FROM ' .
            $this->tableName .
            ' WHERE ' .
            'id = ' .
            $id,
            $params
        );
    }
}