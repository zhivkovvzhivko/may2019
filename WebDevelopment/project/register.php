<?php

require_once 'index.php';

$username = readline();
$password = readline();
$confirm = readline();

$userService = new Services\Users\UserService(
    new Repositories\Users\UserRepository(
        $db
    )
);

$userDTO = new Data\Users\UserDTO($username, $password, $confirm);

try {
    $userService->register($userDTO);
} catch (Exception $e) {
    echo $e->getMessage();
}
