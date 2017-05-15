<?php
    require_once 'config.php';
    require_once 'db_conn.php';
    session_start();

    require_once 'head.php';

    require_once "User.php";
    
    $newUser = new User();
    $newUser->setUsername('newUser');
    $newUser->saveToDB($mysqli);

    echo 'Witaj na stronie głównej';
    require_once 'foot.php';
    
    require_once "newuser.php"; 
?>
