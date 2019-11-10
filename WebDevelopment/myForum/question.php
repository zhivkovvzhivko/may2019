<?php

require_once 'common.php';

if (!isset($_GET['id'])) {
    header('Location: '. url('categories.php'));
    exit;
}

$id = $_GET['id'];

require_once 'db/question_queries.php';
require_once 'db/answer_queries.php';

$questions = getQuestionById($db, $id);
$answers = getAnswersByQuestionsId($db, $id);
//echo '<pre/>'; print_r($answers); exit(' tuk sam ');
//$answers = [];

if(isset($_POST['answer'])) {
    $body = $_POST['body'];
    answer($db, $id, $userId, $body);
    header('Location: '. url('question.php?id='. $id));
}

require_once 'templates/question.php';
