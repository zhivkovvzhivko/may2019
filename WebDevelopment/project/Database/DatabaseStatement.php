<?php

namespace Database;

class DatabaseStatement implements DatabaseStatementInterface
{
    private $pdoStmt;

    public function __construct(\PDOStatement $pdoStmt)
    {
        $this->pdoStmt = $pdoStmt;
    }

    public function execute(array $params = []): ResultSetInterface
    {
        $this->pdoStmt->execute($params);
        return new PDOResultSet($this->pdoStmt);
    }
}
