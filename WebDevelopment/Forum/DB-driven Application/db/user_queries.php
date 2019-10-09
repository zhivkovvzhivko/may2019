<?php

function hasLiked(PDO $db, $user_id, $question_id) : bool
{
    $query = "SELECT * FROM user_likes WHERE user_id = ? AND question_id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$user_id, $question_id]);

    return !empty($stmt->fetchAll(PDO::FETCH_ASSOC));
}

function removeLikes(PDO $db, $user_id, $question_id) {
    $query = "DELETE FROM user_likes WHERE user_id = ? AND question_id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$user_id, $question_id]);
}

function user_likes(PDO $db, $user_id, $question_id) {
    $query = "INSERT INTO user_likes(user_id, question_id) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$user_id, $question_id]);
}

function logout(PDO $db, string $authId) {
    $query = "
        DELETE FROM authentications WHERE auth_string = ?
    ";
    $stmt = $db->prepare($query);
    $stmt->execute([$authId]);
}

function getRolesByUserId($db, $userId) : array
{
    $query = "
        SELECT 
            r.name
        FROM
            users_roles ur
         INNER JOIN roles r ON ur.role_id = r.id
         WHERE user_id = ?
    ";

    $stmt = $db->prepare($query);
    $stmt->execute([$userId]);


    return array_map(function($arr) { return $arr['name'];}, $stmt->fetchAll(PDO::FETCH_ASSOC));
    /* Abobe $stmt->fetchAll(PDO::FETCH_ASSOC) returns:
    [
        ['name' => 'USER']
        ['name' => 'Admin']
    ]
    */
}

function getUserByAuthId(PDO $db, string $authID) : int
{
    $query = "SELECT user_id FROM authenticaton WHERE auth_string = :auth_string";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ':auth_string' => $authID
    ]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if($data && $data['user_id']) {
        return (int)$data['user_id'];
    }
    return -1;
}

function isAuthenticationString(PDO $db, int $userId) : string
{
    $query = "SELECT auth_string FROM authenticaton WHERE user_id = :userId";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ':userId' => $userId
    ]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if($data && $data['auth_string']) {
        return $data['auth_string'];
    }

    $authString = uniqid();
    $query = "INSERT INTO authentications(auth_string, user_id) VALUES(':authString', ':userId')";

    $stmt = $db->prepare($query);
    $stmt->execute([
        ':authString' => $authString,
        ':userId' => $userId
    ]);

    return $authString;
}

function verify_credentials(PDO $db, string $username, string $password) : int
{
    $query = "
        SELECT id, password,  
        FROM 
            users
        WHERE 
            username = :username
    ";


    echo 'podaden username: ' . $username, '\n';
    $stmt = $db->prepare($query);
    if (!$stmt->execute([':username' => $username])) {
        echo '\n', 'I am in execute method!', '\n';
        return -1;
    }
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user['password'] == $password) {
        return (int)$user['id'];
    }
    echo '\n', 'I am before End!', '\n';
    return -1;
}

function register(PDO $db, string $username, string $password) : bool
{
    $query = "INSERT INTO users (username, password)  VALUES (?, ?)";

    $stmt = $db->prepare($query);
    $result = $stmt->execute([
        $username,
        $password
//        password_hash($password, PASSWORD_ARGON2I) // Inserts 0 to DB ?!!!
    ]);

    $userId = $db->lastInsertId();

    $roles = ['USER'];

    if ($userId == 1) {
        $roles[] = 'ADMIN';
    }

    foreach($roles as $roleName) {
        $query = 'SELECT id FROM roles WHERE name = '. $roleName;
        $roleId = $db->query($query)->fetch(PDO::FETCH_ASSOC)['id'];
//        $stmt = $db->prepare($query);
//        $data = $stmt->fetch(PDO::FETCH_ASSOC);
//        $roleId = $data['id'];

        $query = "INSERT INTO user_roles(user_id, role_id) VALUES($userId, $roleId)";
        $stmt = $db->query($query);
//        $query = "INSERT INTO user_roles(user_id, role_id) VALUES(?, ?)";
//        $stmt = $db->prepare($query);
//        $stmt->execute([$userId, $roleID]);
    }

    return $result;
}