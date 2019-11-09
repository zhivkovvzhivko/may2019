<?php

require_once 'db/db_connection.php';
require_once 'db/user_queries.php';

if (isset($_POST['username'], $_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $userId = verify_credentials($db, $username, $password);

    if ($userId != -1) {
        $authString = issueAuthenticationString($db, $userId);
        header('Location: categories.php?authId='. $authString);
    } else {
        $response = 'Invalid username or password';
    }
}

require_once 'templates/login_form.php';
