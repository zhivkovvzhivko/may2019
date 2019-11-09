<html>
    <head>
        <title>Categories</title>
    </head>
    <h1>Categories list</h1>
    <body>
        <table border="1">
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Question count</td>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($categories as $category) : ?>
            <tr>
                <td><?= $category['name']; ?></td>
                <td><?= $category['questions_count']; ?></td>
            </tr>            
            <?php endforeach; ?>
            </tbody>
        </table>
    </body>
    <div id="response" style="color: red">
        <?= $response ?? null ?>
    </div>
</html>