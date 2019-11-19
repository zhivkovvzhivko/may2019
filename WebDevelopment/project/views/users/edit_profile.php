<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit</title>
    </head>
    <body>
    <h1>Edit profile</h1>
    <div id="error" style="color:red">
        <h3><?= $error; ?></h3>
    </div>
    <form method="post">
        Username: <input type="text" name="username" value="<?= $user->getUsername(); ?>"><br/>
        Old Password: <input type="text" name="old_password"><br/><br/>
        New Password: <input type="text" name="new_password"><br/><br/>
        <input type="submit" name="edit" value="Edit!">
    </form>
    </body>
</html>
