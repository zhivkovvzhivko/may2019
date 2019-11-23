<?php

namespace Database\ORM\Repository;

use Database\ORM\QueryBuilderInterface;

abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var string
     */
    private $entity;

    /**
     * @var string
     */
    private $table;

    /**
     * @var string
     */
    private $primaryKey;

    /**
     * @var RepositoryInterface[]
     */
    protected $relatedPluralRepositories;

    /**
     * @var RepositoryInterface[]
     */
    protected $relatedSingularRepositories;

    /**
     * @var QueryBuilderInterface
     */
    private $queryBuilder;

    /**
     * AbstractRepository constructor.
     * @param string $entity
     * @param string $table
     * @param string $primaryKey
     * @param RepositoryInterface[] $relatedPluralRepositories
     * @param RepositoryInterface[] $relatedSingularRepositories
     * @param QueryBuilderInterface $queryBuilder
     */
    public function __construct(string $entity, string $table, string $primaryKey, array $relatedPluralRepositories, array $relatedSingularRepositories, QueryBuilderInterface $queryBuilder)
    {
        $this->entity = $entity;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->relatedPluralRepositories = $relatedPluralRepositories;
        $this->relatedSingularRepositories = $relatedSingularRepositories;
        $this->queryBuilder = $queryBuilder;
    }


    public function findAll($orderBy = []): \Generator
    {
        $builder = $this->queryBuilder->select()
            ->from($this->table);

        if (!empty($orderBy)) {
            $builder->orderBy($orderBy);
        }

        $result = $builder->build()->fetchAll($this->entity);

        foreach ($result as $entity) {
            yield $this->populateNavigationProperties($entity);
        }
    }

    public function findBy(array $where, $orderBy = []): \Generator
    {
        $builder = $this->queryBuilder->select()
            ->from($this->table)
            ->where($where);

        if (!empty($orderBy)) {
            $builder->orderBy($orderBy);
        }

        $result = $builder->build()->fetchAll($this->entity);
        foreach ($result as $entity) {
            yield $this->populateNavigationProperties($entity);
        }
    }

    public function findOne($primaryKey)
    {
        $result = $this->queryBuilder->select()
            ->from($this->table)
            ->where([$this->primaryKey => $primaryKey])
            ->build()
            ->fetch($this->entity);

        return $this->populateNavigationProperties($result);
    }

    /**
     * @param \Generator $result
     */
    public function populateNavigationProperties($entity)
    {
//            echo '<pre/>'; print_r($entity); exit(' tuk sam 1'); // Check Why $entity out of array is User, inside becomes Question?!!
        foreach ($this->relatedSingularRepositories as $key => $repository) {
//            echo '<pre/>'; print_r($entity); exit(' tuk sam 1');
            $setter = 'set' . ucfirst($key); // setQuestion()
            $getter = 'get' . ucfirst($this->primaryKey); // getId()
            $relatedObject = $repository->findBy(['id' => $entity->$getter()]);
            $relatedObject = $relatedObject->current();
            $entity->$setter($relatedObject); // $user->setAuhtor($relatedObject)
        }

        foreach ($this->relatedPluralRepositories as $key => $repository) {
            $setter = 'set' . ucfirst($key); // setQuestions
            $foreignKey = rtrim($this->table, 's') . '_id'; // user_id
            $getter = 'get' . ucfirst($this->primaryKey); // getId()

            $relatedObject = $repository->findBy([$foreignKey => $entity->$getter()]);
            $entity->$setter($relatedObject);
        }

        return $entity;
    }
}
