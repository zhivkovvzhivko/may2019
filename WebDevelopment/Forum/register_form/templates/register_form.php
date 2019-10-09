<html>
    <head>
        <meta charset="UTF-8">
        <title>Register Form</title>
        <link rel="stylesheet" href="templates/style/styles.css">
    </head>
    <body>
        <form method="post">
            Username: <input type="text" name="username"/>
            Pass: <input type="password" name="password"/>
            <input type="submit"/>
        </form>
        <div id="response" style="color: red">
            <?= $response = $response ?? null; ?>
        </div>
    </body>
</html>