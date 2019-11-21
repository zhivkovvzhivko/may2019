<?php

namespace Database\ORM;

use Database\DatabaseStatementInterface;
use Database\ORM\QueryBuilderInterface;
use Database\DatabaseInterface;
use Database\ResultSetInterface;

class MySqlQueryBuilder implements QueryBuilderInterface
{
    /*
     * @var DatabaseInterface
     */
    private $db;

    /*
     * @var string
     */
    private $query;

    private $params;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
        $this->query = '';
        $this->params = [];
    }

    public function select(array $columns = []): QueryBuilderInterface
    {
        $query = 'SELECT ';
        if (empty($column)) {
            $query .= '* ';
        } else {
            $query .= implode(', ', $columns);
        }

        $this->query .= $query;

        return $this;
    }

    public function from(string $table): QueryBuilderInterface
    {
        $this->query .= ' FROM '. $table;

        return $this;
    }

    public function where(array $criteria = []): QueryBuilderInterface
    {
        $query = ' WHERE 1=1 ';

        foreach(array_keys($criteria) as $column) {
            $query .= ' AND '. $column .' = ? ';
        }

        $this->query .= $query;
        $this->params = array_values($criteria);

        return $this;
    }

    public function orderBy(array $order): QueryBuilderInterface
    {
        $query = ' ORDER BY ';

        foreach ($order as $column => $criterion) {
            $query .= $column .' '. $criterion .',';
        }

        $this->query .= rtrim($query, ',');

        return $this;
    }

    public function groupBy(array $columns)
    {
        $query = ' GROUP BY ' . implode(', ', $columns);
        $this->query .= $query;

        return $this;
    }

    public function avg($value): string
    {
        return 'AVG('. $value .')';
    }

    public function sum($value): string
    {
        return 'SUM('. $value .')';
    }

    public function min($value): string
    {
        return 'MIN('. $value .')';
    }

    public function max($value): string
    {
        return 'MAX('. $value .')';
    }

    public function insert(string $table, array $values): DatabaseStatementInterface
    {
        $query = 'INSERT INTO '
            .$table. ' ('. implode(', ', array_keys($values)) .')'
            .' VALUES ('
            . implode(', ', array_values(
                array_fill(0, count($values), '?')
            )) . ')';

        $stmt = $this->db->query($query);
        $stmt->execute(array_values($values));

        return $stmt;
    }

    public function build(): ResultSetInterface
    {
 echo '<pre/>'; print_r($this->query);
        return $this->db->query($this->query)->execute($this->params);
    }

    public function update(string $table, array $values, array $where): DatabaseStatementInterface
    {
        $query = 'UPDATE '. $table .' SET ';

        foreach(array_keys($values) as $column) {
            $query .= $column . ' = ?, ';
        }

        $query = rtrim($query, ', ');
        $query .= ' WHERE 1=1 ';
        foreach(array_keys($where) as $column) {
            $query .= ' AND '. $column .' = ? ';
        }

        $stmt = $this->db->query($query);
        $stmt->execute(array_merge(array_values($values), array_values($where)));

        return $stmt;
    }

    public function delete(string $table, array $where): DatabaseStatementInterface
    {
        $query = 'DELETE FROM '. $table . ' WHERE 1=1 ';
        foreach(array_keys($where) as $column) {
            $query .= ' AND '. $column .' = ?';
        }

        $stmt = $this->db->query($query);
        $stmt->execute(array_values($where));

        return $stmt;
    }
}