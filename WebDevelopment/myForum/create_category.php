<?php

require_once 'common.php';
require_once 'db/category_queries.php';

if (!hasRole($db, $userId, 'ADMIN')){
    header('Location: '. url('logout.php'));
    exit;
}

if (isset($_POST['title'])) {
    $name = $_POST['title'];
    
    createCategory($db, $name);
    header('Location: '. url('categories.php'));
    exit;
}
require_once 'templates/create_category.php';
