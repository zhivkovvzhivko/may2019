<html>
    <head>
        <meta charset="UTF-8">
        <title>Register Form</title>
        <link rel="stylesheet" href="templates/style/styles.css">
    </head>
    <body>
        <h1>Register Form</h1>
        Or go to <a href="login.php">login</a>, if you have an account
        <form method="post">
            Username: <input type="text" name="username"/>
            Pass: <input type="password" name="password"/>
            <input type="submit"/>
        </form>
        <div id="response">
            <?= $response = $response ?? null; ?>
        </div>
    </body>
</html>