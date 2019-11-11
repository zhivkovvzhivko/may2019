<?php

include_once 'db/db_connection.php';
include 'db/user_queries.php';

$response = '';
if (isset($_POST['username'], $_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = register($db, $username, $password);

    if($result) {
        header('Location: login.php');
    } else {
        echo 'Error!';
    }
}

include_once 'templates/register_form.php';
