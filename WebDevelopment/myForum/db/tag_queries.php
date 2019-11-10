<?php

function findTag(PDO $db, $tagName) : int
{
    $query = 'SELECT id FROM tags WHERE name = ?';
    $stmt = $db->prepare($query);
    $stmt->execute([$tagName]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data & $data['id']) {
        return $data['id'];
    }

    $query = 'INSERT INTO tags (name) VALUES (?)';
    $stmt = $db->prepare($query);
    $stmt->execute([$tagName]);
    
    return (int)$db->lastInsertId();
}

function getAllTags($db) : array
{
    $query = '
        SELECT
            t.id,
            t.name,
            COUNT(q.id) AS questions_count
        FROM
            questions_tags AS qt
        INNER JOIN 
            tags AS t
        ON 
            qt.tag_id = t.id
        INNER JOIN
            questions AS q
        ON
            qt.question_id = q.id
    ';

    return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}
