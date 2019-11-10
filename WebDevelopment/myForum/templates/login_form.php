<html>
    <head>
        <title>Login Form</title>
    </head>
    <body>
        <h1>Login Form</h1>
        Or go to <a href="register.php">register</a> first
        <br/>
        <br/>
        <form method="post">
            Username: <input type="text" name="username"> <br/>
            Password: <input type="text" name="password"> <br/>
            <input type="submit"/>
        </form>
        <div id="response" style="color: red">
            <?= $response ?? null ?>
        </div>
    </body>
</html>