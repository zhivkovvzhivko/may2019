<html>
    <head>
        <title>Create category</title>
    </head>
    <body>
        <?php include_once 'logged_in_header.php' ?>
        <a href="<?= url("categories.php") ?>">Back to categories</a>

        <h1>Create category</h1>
        
            <form method="post">
                Name: <input type="text" name="title"/><br/>
                <input type="submit" name="create"/>
            </form>
    </body>
</html>
