<?php

function answer($db, string $questionId, int $userId, string $body) {
    $query = "
        INSERT INTO answers(body, authorId, questionId)
        VALUES (:body, :authorId, :questionId)
    ";

    $stmt = $db->prepare($query);
    $stmt->execute([
        ':body' => $body,
    ':authorId' => $userId,
    ':questionId' => $questionId
    ]);
}

function getAnswerByQuestionId(PDO $db, int $questionId) : int
{
    $query = "
        SELECT 
            a.id,
            a.body,
            a.created_on,
            u.username AS 'author_name'
        FROM
            answers AS a
        INNER JOIN 
            users u ON a.author_id = u.id
        WHERE
            a.question_id = ?
        ORDER BY
            a.created_on DESC,
            a.id ASC
    ";

    $stmt = $db->prepare($query);
    $stmt->execute([$questionId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
