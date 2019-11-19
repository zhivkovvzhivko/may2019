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

        <?php if (null === $user->getProfilePictureUrl()): ?>
            <h2>There are is no profile picture</h2>
        <?php else:  ?>
            <img width="10%" height="25%" src="/may2019/WebDevelopment/project/<?= $user->getProfilePictureUrl(); ?>"/>
            <br/>
            <br/>
        <?php endif; ?>

        <a href="edit_profile.php">Edit your profile</a>
    </body>
</html>
