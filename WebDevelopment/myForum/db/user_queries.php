<?php

function hasLiked(PDO $db, $userId, $questionId) : bool
{
    $query = 'SELECT * FROM user_likes WHERE user_id = ? AND question_id = ?';
    $stmt = $db->prepare($query);
    $stmt->execute([$userId, $questionId]);

    return !empty($stmt->fetch(PDO::FETCH_ASSOC));
}

function removeLike(PDO $db, int $userId, int $questionId)
{
    $query = 'DELETE FROM user_likes WHERE user_id =? AND question_id = ?';
    $stmt = $db->prepare($query);
    $stmt->execute([$userId, $questionId]);
}

function like(PDO $db, int $userId, int $questionId)
{
    $query = 'INSERT INTO user_likes (user_id, question_id) VALUES (?, ?)';
    $stmt = $db->prepare($query);
    $stmt->execute([$userId, $questionId]);
}

function logout(PDO $db, string $authId) {
    $query = 'DELETE FROM authentications WHERE auth_string = ?';
    $stmt = $db->prepare($query);
    $stmt->execute([$authId]);
}

function getRolesByUserId(PDO $db, int $userId) {
    $query = '
        SELECT 
               r.name 
        FROM 
             users_roles AS ur
        INNER JOIN
            roles AS r
        ON
            r.id = ur.role_id
        WHERE 
              ur.user_id = ?
    ';

    $stmt = $db->prepare($query);
    $stmt->execute([$userId]);
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return array_map(function ($role) {
        return $role['name'];
    }, $roles);
}

function getUserByAuthId(PDO $db, string $authId) {

    $query = '
        SELECT
            user_id
        FROM
            authentications
        WHERE
            auth_string = ?
    ';

    $stmt = $db->prepare($query);

    $stmt->execute([$authId]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if($data & isset($data['user_id'])) {

        return (int)$data['user_id'];
    }

      return -1;
}

function issueAuthenticationString(PDO $db, int $user_id)
{
    $query = '
        SELECT
            auth_string
        FROM
            authentications
        WHERE
            user_id = ?
    ';

    $stmt = $db->prepare($query);
    $stmt->execute([$user_id]);
    $data =$stmt->fetch(PDO::FETCH_ASSOC);

    if ($data & $data['auth_string']) {
        return $data['auth_string'];
    }

    $authString = uniqid();

    $query = 'INSERT INTO authentications (auth_string, user_id) VALUES (?, ?)';
    $stmt = $db->prepare($query);
    $stmt->execute([$authString, $user_id]);

    return $authString;
}

function verify_credentials(PDO $db, string $username, string $password) : int
{
    $query = '
        SELECT
            id,
            password
        FROM
            users
        WHERE
            username = ?
    ';

    $stmt = $db->prepare($query);
    if (!$stmt->execute([$username])) {
        return -1;
    }

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $password_hash = $user['password'];

    $result = password_verify($password, $password_hash);

    if($result) {
        return (int)$user['id'];
    }

    return -1;
}

function register(PDO $db, string $username, string $password) : bool
{

    $query = 'INSERT INTO users (username, password) VALUES(?, ?)';
    $stmt = $db->prepare($query);
    
    $result = $stmt->execute([
        $username,
        password_hash($password, PASSWORD_ARGON2I)
    ]);

    $userId = $db->lastInsertId();

    $roles = ['USER'];

    if($userId == 1) {
        $roles[] = 'ADMIN';
    }

    foreach($roles as $roleName) {

        $query = 'SELECT id FROM roles WHERE name = ?';
        $stmt = $db->prepare($query);
        $stmt->execute([$roleName]);
        $roleId = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

        $query = 'INSERT INTO users_roles (user_id, role_id) VALUES (?, ?)';
        $stmt = $db->prepare($query);
        $stmt->execute([$userId, $roleId]);
    }

    return $result;
}
