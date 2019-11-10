<?php

function answer(PDO $db, int $questionId, int $userId, string $body)
{
    $query = '
        INSERT INTO answers( 
            body, 
            question_id, 
            author_id
        ) VALUES (
              ?, 
              ?, 
              ?
        )    
    ';

    $stmt = $db->prepare($query);
    $stmt->execute([$body, $questionId, $userId]);
}

function getAnswersByQuestionsId(PDO $db, $questionId)
{
    $query = '
        SELECT 
            a.id,
            a.body,
            u.username AS author_name
        FROM
            answers a
        INNER JOIN
            users u
        ON 
            u.id =  a.author_id
        WHERE
            a.question_id = ?
        ORDER BY 
            a.created_on DESC,
            a.id
    ';

    $stmt = $db->prepare($query);
    $stmt->execute([$questionId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
