<?php

namespace Database\ORM;

use Database\ResultSetInterface;

interface QueryBuilderInterface
{
    public function select(array $columns = []): QueryBuilderInterface;

    public function from(string $table): QueryBuilderInterface;

    public function where(array $criteria = []): QueryBuilderInterface;

    public function orderBy(array $order): QueryBuilderInterface;

    public function groupBy(array $columns);

    public function avg($value): string;

    public function sum($value): string;

    public function min($value): string;

    public function max($value): string;

    public function build(): ResultSetInterface;
}
