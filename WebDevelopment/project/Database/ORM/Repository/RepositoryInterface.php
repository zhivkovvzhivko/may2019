<?php

namespace Database\ORM\Repository;

interface RepositoryInterface
{
    public function findAll($orderBy = []): \Generator;

    public function findBy(array $where, $orderBy = []): \Generator;

    public function findOne($primaryKey);
}