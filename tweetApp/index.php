<?php
    session_start(); 
    require_once 'config.php';
    require_once 'db_conn.php';

    require_once 'head.php';

    require_once "User.php";
    include_once "newuser.php"; 
    
    if (!empty($_SESSION['userId']) && !empty($_SESSION['username']))
    {
        include_once 'main.php';
    }
    else 
    {
        include_once 'login.php'; 
        
    
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']))
    {
        $newUsername = $_POST['username']; 
        $newEmail = $_POST['email']; 
        $newPassword = $_POST['password']; 
        
        $sql = "SELECT email FROM Users"; 
        $result = $mysqli->query($sql);
        
        if ($result == true)
        {
            $row = $result->fetch_assoc(); 
            if ($row['email'] == $newEmail)
            {
                echo "Podany email już istnieje w bazie"; 
            }
            else 
                {
        
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
                                if ($id > 0)
                                {
                                    $_SESSION['userId'] = $id; 
                                    $_SESSION['username'] = $username; 
                                }
                            }
                        }
                //var_dump($id); 
                    }       
                }
                $user = User::loadUserById($mysqli, $id); 
        }
    }
        
    }
    
    $mysqli->close(); 
    $mysqli = null; 
    //require_once 'foot.php';
    
?>
