<html>
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
</head>
<body>
If you don't have an account, <a href="register.php">register</a> first.
<h1>Login Form</h1>
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