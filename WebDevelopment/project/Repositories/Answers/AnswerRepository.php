<?php

namespace Repositories\Answers;

use Data\Entity\Answer;
use Database\ORM\QueryBuilderInterface;
use Database\ORM\Repository\AbstractRepository;
use Repositories\Questions\QuestionRepository;
use Repositories\Users\UserRepository;

class AnswerRepository extends AbstractRepository
{
    private $userRepository;

    public function __construct(QueryBuilderInterface $queryBuilder)
    {
        parent::__construct(
            Answer::class,
            'answers',
            'id',
            [],
            [],
            $queryBuilder
        );
    }

    public function setUserRespostory(UserRepository $userRepository)
    {
        $this->relatedSingularRepositories['author'] = $userRepository;
    }

    public function setQuestionsRepository(QuestionRepository $questionRepository)
    {
        $this->relatedSingularRepositories['questions'] = $questionRepository;
    }
}
