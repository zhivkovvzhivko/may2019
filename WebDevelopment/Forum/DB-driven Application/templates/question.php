<html>
<head>
    <meta charset="UTF-8">
    <title>Question</title>
</head>
<body>
<?php include_once 'logged_in_header.php'; ?>
    <a href="<?= url("category.php?id={$question['category_id']}"); ?>">Back to questions in this category</a>
    <div class="question">
        <span>
            Title:
            <?=htmlspecialchars($question['title'])?>
        </span>
        <br/>
        <br/>
        <span>
            <?=htmlspecialchars($question['body'])?>
        </span>
        <br/>
        <br/>
        Asked by:
        <span><?=htmlspecialchars($question['author_name'])?></span>
        <span><?=htmlspecialchars($question['created_on'])?></span>
        <span><?=htmlspecialchars($question['category_name'])?></span>
    </div>
<hr/>
<?php foreach($answers as $answer) : ?>
    <hr/>
    <div>by <?= htmlspecialchars($answer['author_name'])?> </div>
    <div>by <?= htmlspecialchars($answer['body'])?> </div>
<?php endforeach; ?>
<form method="POST">
Your answer here: <textarea></textarea>
    <input type="submit" value="answer!" name="answer"/>
</form>
</body>
</html>
