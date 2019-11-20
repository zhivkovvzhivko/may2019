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
$user = $builder->select()
    ->from('users')
    ->where(['username'=> 'pesho'])
    ->orderBy(['password' => 'ASC'])
    ->build()
    ->fetch(\Data\Users\UserDTO::class);


echo 'usera: ','<pre/>'; print_r($user);

foreach ($user as $prop) {
    print_r($prop);
}
