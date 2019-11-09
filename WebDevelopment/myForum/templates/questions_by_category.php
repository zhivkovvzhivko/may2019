<html>
    <head>
        <title>Questions</title>
    </head>
    <h1></h1>
    <a href="<?= url("ask_question.php?id={$id}") ?>">Add new question</a>
    <body>
        <table border="1">
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div id="response" style="color: red">
            <?= $response ?? null ?>
        </div>
    </body>
</html>