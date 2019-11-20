<?php

namespace Database;

class PDOResultSet implements ResultSetInterface
{
    private $pdoStmt;

    public function __construct(\PDOStatement $pdoStatement)
    {
        $this->pdoStmt = $pdoStatement;
    }
    public function fetch($className) : \Generator
    {
        while ($row = $this->pdoStmt->fetchObject($className)) {
            yield $row;
        }
    }
}