<?php
if (isset($_POST['username']) && isset($_POST['password']))
{
    $username = $_POST['username']; 
    $password = $_POST['password']; 
    
    $sql = "SELECT * FROM Users"; 
    $result = $mysqli->query($sql); 
    
    if ($result == true && $result->num_rows>0)
    {
        foreach ($result as $row)
        {
            if ($row['username'] && password_verify($password, $row['hashed_password']))
            {
                $id = $row['id']; 
                
                if ($id>0)
                {
                    $_SESSION['userId'] = $id; 
                    $_SESSION['username'] = $username; 
                }
            }
        }
    }
}
?>
<html>
    <body>
        <form action="" method="post">
            <input type="text" name="username" placeholder="username">
            <br>
            <br>
            <input type="password" name="password" placeholder="password">
            <br>
            <br>
            <input type="submit" value="Log in">
        </form>
    </body>
</html>