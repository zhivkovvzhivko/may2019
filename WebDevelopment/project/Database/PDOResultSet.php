<?php

namespace Database;

class PDOResultSet implements ResultSetInterface
{
    /*
     * @var \PDOStatement
     */
    private $pdoStatement;

    public function __construct(\PDOStatement $pdoStatement)
    {
        $this->pdoStatement = $pdoStatement;
    }
    public function fetchAll($className): \Generator
    {
        while ($row = $this->pdoStatement->fetchObject($className)) {
            yield $row;
        }
    }

    public function fetch($className)
    {
        return $this->pdoStatement->fetchObject($className);
    }
}