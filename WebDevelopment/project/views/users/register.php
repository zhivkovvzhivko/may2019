<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <h1>Register form</h1>
        <div id="error" style="color:red">
            <h3><?= $error; ?></h3>
        </div>
        <form method="post">
            Username: <input type="text" name="username"><br/>
            Password: <input type="text" name="password"><br/>
            Confirm: <input type="text" name="confirm"><br/><br/>
            <input type="submit" name="register" value="Register!">
        </form>
    </body>
</html>