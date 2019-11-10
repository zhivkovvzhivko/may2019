<?php

require_once 'common.php';

$categoryId = 1;
if (isset($_GET['id'])) {
    $categoryId = (int)$_GET['id'];
}

require_once 'db/category_queries.php';
require_once 'db/tag_queries.php';

$categories = getAllCategories($db);
$tags = getAllTags($db);

if (isset($_POST['title'], $_POST['body'])) {
    $title = $_POST['title'];
    $body =  $_POST['body'];
    $category = $_POST['category'];
    $existingTags = $_POST['existing_tags'] ?? [];
    $newTags = explode(', ', $_POST['tags']);

    require_once 'db/question_queries.php';

    $questionId = createQuestion($db, $userId, $title, $body, $category, $existingTags, $newTags);

    if($questionId) {
        header('Location: question.php?id='. $questionId);
        exit;
    }
    
}

require_once 'templates/ask_question.php';