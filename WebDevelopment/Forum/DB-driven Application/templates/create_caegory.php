<html>
    <head>
        <meta charset="UTF-8">
        <title>Create category</title>
    </head>
    <body>
        <?php include_once 'logged_in_header.php'; ?>
        <a href="<?= url("categories.php"); ?>">Back to Categories</a>
        <form method="POST">
            Name <input type="text" name="name"/>
            <input type="submit" value="Create!"/>
        </form>
    </body>
</html>
