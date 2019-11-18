<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h1>Login Form</h1>
<div id="error" style="color:red">
    <h3><?= $error; ?></h3>
</div>
<form method="post">
    Username: <input type="text" name="username"><br/>
    Password: <input type="text" name="password"><br/><br/>
    <input type="submit" name="login" value="Login!">
</form>
</body>
</html>