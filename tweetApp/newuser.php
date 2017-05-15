<?php 
//include "User.php"; 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && $_POST['email'] && $_POST['password'])
{
    $username = $_POST['username']; 
    $email = $_POST['email']; 
    $password = $_POST['password']; 
    
    
   
    $user = new User(); 
    $user->setUsername($username); 
    $user->setEmail($email); 
    $user->setPassword($email); 
        
    $connection = new mysqli(DB_USER, DB_PASSWORD, DB_HOST, DB_NAME); 
        
    $user->saveToDB($connection); 
    
    echo "Utworzono nowego użytkownika"; 
   
}
?>
<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <form action="main.php" method="post">
            <input type="text" name="username" placeholder="Username:">
            <br>
            <br>
            <input type="email" name="email" placeholder="email">
            <br>
            <br>
            <input type="password" name="password" placeholder="password">
            <br>
            <br>
            <input type="submit" value="Utwórz nowego użytkownika">
            <p>Jeśli masz już konto zaloguj się <a href="login.php">tutaj</a></p>
        </form>
    </body>
</html>