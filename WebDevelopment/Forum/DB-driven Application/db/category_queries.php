<?php

function createCategory($db, $name) {
    $query = "INSERT INTO categories ('name') VALUES(?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$name]);
}

function getQuestionsByCategoryId(PDO $db, $category_id)
{
    $query = "
        SELECT
            q.id,
            q.title,
            q.author_id
            u.username AS 'author_name',
            c.name AS 'category_name',
            q.created_on,
            COUNT(a.id) AS answers_count,
            (SELECT COUNT(user_id) FROM user_likes WHERE user_likes.qiestion_id = q.id) AS 'likes_count'
        FROM
            questions AS q
        INNER JOIN users as u ON q.author_id = u.id
        INNER JOIN categories as c ON q.category_id = c.id
        LEFT JOIN answers as a ON a.questions_id = q.id
        WHERE 
            c.id = :category_id
        GROUP BY
            q.id,
            q.title,
            q.author_id
            u.username,
            c.name,
            q.created_on
        ORDER BY
        q.created_on DESC,
        answers_count DESC
    ";

    $db->prepare($query);
    $stmt =$db->execute([
        ':category_id' => $category_id
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllCategories(PDO $db) : array
{
    $query = "
        SELECT c.id, c.name, COUNT(q.id) as questions_count
        FROM
            categories AS c
        LEFT JOIN 
            questions AS q 
        ON 
            c.id = q.category_id
        GROUP BY 
            c.id, c.name
        ORDER BY 
            questions_count DESC 
    ";

//    return $db->prepare($query)->fetchAll(PDO::FETCH_ASSOC);
    return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}