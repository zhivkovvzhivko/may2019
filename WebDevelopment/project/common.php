<?php

use Database\PDODatabase;
use Repositories\Users\UserRepository;

session_start();

spl_autoload_register(function($className) {
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    require_once $className . '.php';
});

$pdo = new PDO("mysql:host=localhost; dbname=forum;", 'root', '');
$db = new PDODatabase($pdo);

$builder = new \Database\ORM\MySqlQueryBuilder($db);

$answerRepository = new \Repositories\Answers\AnswerRepository($builder);
$questionRepository = new \Repositories\Questions\QuestionRepository($answerRepository, $builder);
$userRepository = new UserRepository($questionRepository, $answerRepository, $builder);

$questionRepository->setUserRespostory($userRepository);
$answerRepository->setUserRespostory($userRepository);
$answerRepository->setQuestionsRepository($questionRepository);

//$user = $userRepository->findOne(72);
//$users = $userRepository->findAll();
//foreach($users as $user){
//    print_r($user);
//}
//exit;

$user = $userRepository->findOne(1);

/** @var \Data\Entity\User $user*/
foreach ($user->getQuestions() as $question) {
//    echo " i am in ";
    var_dump($question);
}
///** @var \Data\Entity\User $user*/
//foreach ($user->getAnswers() as $q) {
//    echo " i am in ";
//    var_dump($q);
//}

// -----------------------------------------------------------------------------------

// $user = $builder->select()
//    ->from('users')
//    ->where(['username'=> 'pesho'])
//    ->orderBy(['password' => 'ASC'])
//    ->build()
//    ->fetch(\Data\Users\UserDTO::class);

// $builder->insert(
//    'users',
//    ['username' => 'svetlio', 'password' => '123']
//);

// $builder->update(
//    'users',
//    ['password' => 'nova parola'],
//    ['id' => 74]
//);

// $builder->delete('users', ['id'=>74]);

//foreach ($user as $prop) {
//    print_r($prop);
//}

// -----------------------------------------------------------------------------------

// $builder2 = new \Database\ORM\MySqlQueryBuilder($db);
// $user2 = $builder2->select()
//    ->from('users')
//    ->where(['username'=> 'pesho'])
//    ->orderBy(['password' => 'ASC'])
//    ->build()
//    ->fetchAll(\Data\Users\UserDTO::class);
//
// foreach ($user2 as $prop) {
//    print_r($prop);
// }

// -----------------------------------------------------------------------------------
