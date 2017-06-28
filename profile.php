<?php 
include_once 'User.php'; 

if (isset($_SESSION['useremail']))
{
    $email = $_SESSION['useremail']; 
    $userId = $_SESSION['userId']; 
    
    $usr = User::loadUserById($conn, $userId); 
    $allUsers = User::loadAllUsers($conn); 
    
    $emails = [];
    
    foreach ($allUsers as $user)
    {
        $emails[] = $user->getEmail(); 
    }
    var_dump($emails); 
}
?>

<html>
    <body>
        <form action="" method="post">
            <button type="submit" name="page" value="changePass">You can change your password here</button>
            <button type="submit" name="page" value="changeUsr">You can change your username here</button>
            <button type="submit" name="page" value="changemail">You can change your email here</button>
        </form>
    </body>
</html>

<?php

if (isset($_POST['page']) && isset($_POST['page']) === 'changePass')
{
    echo "<form action='' method='post'>
    <input type='password' name='currentpass' placeholder='Your current password'>
    <input type='password' name='newpass' placeholder='Your new password'>
    <input type='password' name='newpass2' placeholder='Re-enter your new password'>
    <input type='submit' value='changepass'>
    </form>"; 
    
    if (!empty($_POST['currentpass']) && !empty($_POST['newpass']) && !empty($_POST['newpass2']))
    {
        $currentpass = $_POST['currentpass']; 
        $newpass = $_POST['newpass']; 
        $newpass2 = $_POST['newpass2']; 
        
        if (password_verify($currentpass, $user->getHashPass()))
        {
            if ($newpass == $newpass2)
            {
                $hashedPass = password_hash($newpass, PASSWORD_BCRYPT); 
                $user->setHashPass($hashedPass); 
                $user->saveToDB($conn); 
            }
            else 
            {
                echo "Passwords are not identical"; 
            }
        }
        else 
        {
            echo "Incorrect current password"; 
        }
    }
    else 
    {
        
    }
}