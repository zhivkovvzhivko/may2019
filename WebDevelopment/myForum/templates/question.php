<html>
    <head>
        <title>Question</title>
    </head>
    <body>
        <div class="question">
            <span>
                Title: <?= $questions['title'] ?>
            </span>
            <br/>
            <br/>
            <span><?= $questions['body'] ?></span>
            <br/>
            <br/>
            Ask by:
            <span><?= $questions['author_name'] ?> |</span>
            <span><?= $questions['created_on'] ?> |</span>
            <span><?= $questions['category_name'] ?> |</span>
        </div>
        <hr/>
        <?php foreach($answers as $answer): ?>
        <div>by: <?= $answer['author_name'] ?? null; ?></div>
        <div><?= $answer['body'] ?? null; ?></div>
        <?php endforeach; ?>
        <form method="post">
            Your answer here:
            <textarea name="body"></textarea>
            <input type="submit" value="Answer!" name="answer"/>
        </form>
    </body>
</html>
