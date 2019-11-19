<?php

require_once 'secure_common.php';

$error = '';
if (isset($_POST['edit'])) {
    $username = $_POST['username'];
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];

    try {
        $userService->edit($id, new \Data\Users\UserEditDTO($id, $username, $oldPassword, $newPassword));
        header('Location: profile.php');
    } catch (\Exception\User\EditProfileException $e) {
        $error = $e->getMessage();
    } catch (Exception $e) {
        $error = 'Something went wrong';
    }
}

require_once 'views/users/edit_profile.php';
