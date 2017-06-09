<?php
    require_once 'config.php';
    require_once 'db_conn.php';
    session_start();

    require_once 'head.php';

    require_once "User.php";
    
    //$newUser = new User();
    //$newUser->setUsername('newUser');
    //$newUser->saveToDB($mysqli);

    echo 'Witaj na stronie głównej <br><br>';
    echo "Jeśli jesteś zarejestrowanym użytkownikiem ". "<a href='login.php'>kliknij tutaj</a>";  
    require_once 'foot.php';
    
    require_once "newuser.php"; 
    
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']))
    {
        $newUsername = $_POST['username']; 
        $newEmail = $_POST['email']; 
        $newPassword = $_POST['password']; 
        
        $newUser = new User(); 
        $newUser->setUsername($newUsername); 
        $newUser->setEmail($newEmail); 
        $newUser->setPassword($newPassword); 
        $newUser->saveToDB($mysqli); 
        echo "Jesteś zarejestrowany w bazie. Przejdź do panelu logowania"; 
    }
?>
