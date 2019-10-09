<?php

include_once 'db/db_connection.php';

$response = '';
$username = '';
$password = '';
if (isset($_POST['username']) && $_POST['password']) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    include_once 'db/user_queries.php';

    $userID = verify_credentials($db, $username, $password);
//    var_dump($result);

    if ($userID != -1) {
        $authString = isAuthenticationString($db, $userID);
        header("Location: categories.php?authId=$authString");
    } else {
        $response = 'Invalid username or password';
    }
}

include_once 'templates/login_form.php';
