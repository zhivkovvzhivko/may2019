<html>
    <head>
        <title>Questions</title>
    </head>
    <body>
    <?php include_once 'logged_in_header.php' ?>

    <a href="<?= url("categories.php") ?>">Back to categories</a> |
    <a href="<?= url("ask_question.php?id={$id}") ?>">Add new question</a>

        <?php foreach ($questions as $question): ?>
        <hr/>
        <div class="question">
            <span>
                <a href="<?= url("question.php?id={$question['id']}") ?>">
                    <?= htmlspecialchars($question['title']) ?>
                </a>
            </span>
            <span>(<?= $question['answers_count'] ?>)</span>
            <br/>
            <span><?= htmlspecialchars($question['author_name']) ?></span>
            <span><?= $question['created_on'] ?></span>
            <span><?= $question['category_name'] ?></span>
        </div>
        <?php endforeach; ?>

        <div id="response" style="color: red">
            <?= $response ?? null ?>
        </div>
    </body>
</html>
