<?php

function getAllCategories(PDO $db) : array
{
    $query = '
        SELECT
            c.id,
            c.name,
            COUNT(q.id) AS questions_count
        FROM
            categories AS c
        LEFT JOIN
            questions as q
        ON
            c.id = q.category_id
        GROUP BY
            c.id, c.name
        ORDER BY
            questions_count,
            c.name
    ';

    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}