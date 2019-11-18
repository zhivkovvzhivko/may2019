<?php

use Database\PDODatabase;
use Repositories\Users\UserRepository;

spl_autoload_register(function($className) {
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    require_once $className . '.php';
});

$pdo = new PDO("mysql:host=localhost; dbname=forum;", 'root', '');
$db = new PDODatabase($pdo);
