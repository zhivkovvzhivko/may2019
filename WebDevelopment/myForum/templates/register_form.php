<html>
<head>
    <title>Register Form</title>
</head>
<body>
    <form method="post">
        Username: <input type="text" name="username"> <br/>
        Password: <input type="text" name="password"> <br/>
        <input type="submit"/>
    </form>
</body>
<div id="response" style="color: red">
    <?= $response ?? null ?>
</div>
</html>