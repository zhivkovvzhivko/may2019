<?php

namespace Repositories\Users;

use Data\Entity\User;
use Database\ORM\QueryBuilderInterface;
use Database\ORM\Repository\AbstractRepository;
use Repositories\Answers\AnswerRepository;
use Repositories\Questions\QuestionRepository;

class UserRepository extends AbstractRepository
{
    public function __construct(QuestionRepository $questionRepository, AnswerRepository $answerRepository, QueryBuilderInterface $queryBuilder)
    {
        parent::__construct(
            User::class,
            'users',
            'id',
            [
                'questions' => $questionRepository,
                'answers' => $answerRepository,
            ],
            [],
            $queryBuilder
        );
    }
}