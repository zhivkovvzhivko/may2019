<html>
    <head>
        <title>Categories</title>
    </head>
    <h1>Categories list</h1>
    <body>
    <?php include_once 'logged_in_header.php' ?>

    <?php if(hasRole($db, $userId, 'ADMIN')): ?>
    <a href=<?= url("create_category.php")?>>Create category</a>
    <?php endif; ?>

    <table border="1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Question count</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($categories as $category) : ?>
            <tr>
                <td>
                    <a href="<?= url("category.php?id={$category['id']}") ?>"><?= $category['name']; ?></a>
                </td>
                <td><?= $category['questions_count']; ?></td>
            </tr>            
            <?php endforeach; ?>
            </tbody>
        </table>
        <div id="response" style="color: red">
            <?= $response ?? null ?>
        </div>
    </body>
</html>
