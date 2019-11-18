<?php

require_once 'index.php';

$username = readline();
$password = readline();

$userService = new Services\Users\UserService(
    new Repositories\Users\UserRepository(
        $db
    ),
    new \Services\Encryption\ArgonEncryptionService()
);

if ($userService->verifyCredentials($username, $password)) {
    echo 'You are logged in the system';
} else {
    echo 'Username or password missmatch';
}