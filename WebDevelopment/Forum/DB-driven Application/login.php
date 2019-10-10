<?php

include_once 'db/db_connection.php';

$response = '';
$username = '';
$password = '';
if (isset($_POST['username']) && $_POST['password']) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    include_once 'db/user_queries.php';

    $userId = verify_credentials($db, $username, $password);

    if ($userId != -1) {
        $authString = isAuthenticationString($db, $userId);
        if ($authString) {
            header("Location: categories.php?authId=$authString");
        } else{
            throw new Exception("'Auth string  for new user can\'t be selected or created'");
        }
    } else {
        $response = 'Invalid username or password';
    }
}

include_once 'templates/login_form.php';
