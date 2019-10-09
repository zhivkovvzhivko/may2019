<?php

require_once 'db/tag_queries.php';

function getLikesByQuestionId() {

}

function createQuestions(
    PDO $db, int $userId, string $title, string $body,
    int $category, array $existingTags, array $newTags) : int
{
    foreach ($newTags as $newTag) {
        $tagId = findTag($db, $newTag);
        $existingTags[] = $tagId;
    }

    $query = "
        INSERT INTO questions (title, body, category_id, author_id, created_on)
        VALUES (:title, :body, :category_id, :author_id, NOW())
    ";

    $stmt = $db->prepare($query);
    $stmt->execute([
        ':title' => $title,
        ':body' => $body,
        ':category_id' => $category,
        ':author_id' => $userId
    ]);

    $questionId = $db->lastInsertId();

    foreach ($existingTags as $tagId) {
        $query = "
            INSERT INTO questions_tags (question_id, tag_id)
            VALUES (:question_id, :tag_id)
        ";

        $stmt = $db->prepare($query);
        $stmt->execute([
            ':question_Id' => $questionId,
            ':tag_id' => $tagId
        ]);
    }

    return (int)$questionId;
}

function getQuestionById(PDO $db, int $id) : array
{
    $query = "
        SELECT
            q.id,
            q.title,
            q.body,
            q.author_id
            u.username AS 'author_name',
            c.name AS 'category_name',
            c.id AS 'category_id',
            q.created_on
        FROM
            question AS q
        INNER JOIN users u ON q.author_id = u.id
        INNER JOIN categories c ON q.category_id = c.id
        WHERE q.id = ?
    ";

    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}