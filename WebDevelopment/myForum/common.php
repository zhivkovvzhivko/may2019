<?php

include_once 'db/db_connection.php';
include_once 'db/user_queries.php';

if (!isset($_GET['AuthId'])) {
    header('Location: login.php');
}

$authId = $_GET['authId'];
$userId = getUserByAuthId($db, $authId);

if ($userId == -1) {
    header('Location: login.php');
    exit;
}

