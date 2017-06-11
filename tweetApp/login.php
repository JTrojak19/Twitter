<?php
if (isset($_POST['username']) && isset($_POST['password']))
{
    $username = $_POST['username']; 
    $password = $_POST['password']; 
    
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