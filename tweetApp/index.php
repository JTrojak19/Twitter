<?php
    session_start(); 
    require_once 'config.php';
    require_once 'db_conn.php';
    session_start();

    require_once 'head.php';

    require_once "User.php";
    
    if (!empty($_SESSION['userId']) && !empty($_SESSION['username']))
    {
        include_once 'main.php';
    }
    else 
    {
        include_once 'login.php'; 
    }

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
            
        $sql = "SELECT * FROM Users"; 
        $result = $mysqli->query($sql); 
        if ($result==true && $result->num_rows>0)
        {
                foreach ($result as $row)
                {
                    if ($row['email']==$newEmail)
                    {
                        $id = $row['id']; 
                        $name = $row['username']; 
                    }
                }
                var_dump($id); 
        }
        $user = User::loadUserById($mysqli, $id); 
        
    }
    
?>
