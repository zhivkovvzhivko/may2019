<?php

namespace Database\ORM;

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
            $query .= $column .' '. $criterion .', ';
        }

        $this->query .= rtrim(',', $query); // check WHY it works only if you change the arguments places ?!!!

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

    public function build(): ResultSetInterface
    {
        echo '<pre/>';
        print_r([
            'query' => $this->query,
            'params' => $this->params
        ]);
        return $this->db->query($this->query)->execute($this->params);
    }
}