<?php

namespace Repositories\Questions;

use Data\Entity\Answer;
use Data\Entity\Question;
use Database\ORM\QueryBuilderInterface;
use Database\ORM\Repository\AbstractRepository;
use Repositories\Answers\AnswerRepository;
use Repositories\Users\UserRepository;

class QuestionRepository extends AbstractRepository
{
    private $userRepository;

    public function __construct(AnswerRepository $answerRepository, QueryBuilderInterface $queryBuilder)
    {
        parent::__construct(
            Question::class,
            'questions',
            'id',
            [
                'answers' => $answerRepository
            ],
            [

            ],
            $queryBuilder
        );
    }

    public function setUserRespostory(UserRepository $userRepository)
    {
        $this->relatedSingularRepositories['author'] = $userRepository;
    }
}
