<?php

function register(PDO $db, string $username, string $password) : bool
{
    $query = " INSERT INTO users (username, password)  VALUES (?, ?) ";

    $stmt = $db->prepare($query);
    $result = $stmt->execute([
        $username,
        $password
//        password_hash($password, PASSWORD_ARGON2I) // Inserts 0 to DB ?!!!
    ]);

    return $result;
}