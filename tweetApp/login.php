<?php
include_once 'User.php'; 
if (isset($_POST['email']) && isset($_POST['password']))
{
    $username = $_POST['email']; 
    $password = $_POST['password']; 
    
    $sql = "SELECT * FROM Users"; 
    $result = $mysqli->query($sql); 
    
    if ($result == true && $result->num_rows>0)
    {
        foreach ($result as $row)
        {
            if ($row['email'] && password_verify($password, $row['hashed_Password']))
            {
                $id = $row['id']; 
                
                if ($id>0)
                {
                    $_SESSION['userId'] = $id; 
                    $_SESSION['username'] = $username; 
                }
            }
            $user = User::loadUserById($mysqli, $id); 
        }
    }
    else if ($row['email']==$email && password_verify($password, $row['hashed_Password']) == false)
    {
        echo "Błędne hasło"; 
    }
    else if ($row['email']!=$email && password_verify ($password, $row['hashed_Password']) == false)
    {
        echo "Błędny email"; 
    }
}
?>
<html>
    <body>
        <form action="" method="post">
            <input type="email" name="email" placeholder="email">
            <br>
            <br>
            <input type="password" name="password" placeholder="password">
            <br>
            <br>
            <input type="submit" value="Log in">
        </form>
    </body>
</html>