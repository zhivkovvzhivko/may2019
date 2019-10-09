<?php

include_once 'db/db_connection.php';
include_once 'templates/register_form.php';

$response = '';
if (isset($_POST['username']) && $_POST['password']) {

    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    include_once 'db/user_queries.php';

    $result = register($db, $username, $password);

    if ($result) {
        header('Location: login.php');
        exit;
    } else {
        echo $response = 'Error';
    }
}

include_once 'templates/register_form.php';
