<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile</title>
    </head>
    <body>
    <h1>Profile</h1>
    <h2 style="color:green">
        Welcome, <?= $user->getUsername(); ?>
    </h2>

    <a href="edit_profile.php">Edit your profile</a>
    </body>
</html>