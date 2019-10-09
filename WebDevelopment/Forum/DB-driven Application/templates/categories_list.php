<html>
    <head>
        <meta charset="UTF-8">
        <title>Categories</title>
    </head>
    <body>
    <?php include_once 'logged_in_header.php'; ?>
    <?php if (hasRole($db, $userId, 'ADMIN')): ?>
        <a href="<?= url("create_category.php") ?>">Create new category</a>
    <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Questions count</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($categories as $category): ?>
            <tr>
                <td>
                    <a href="<?= url('category.php?id=' . $category['id']) ?> ">
                        <?= $category['name'] ?>
                    </a>
                </td>
                <td><?= $category['questions_count'] ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>
