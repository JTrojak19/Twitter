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
            <button type="submit" name="page" value="changePass">change your password</button>
            <button type="submit" name="page" value="changeUsr">change your username </button>
            <button type="submit" name="page" value="changemail">change your email </button>
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
        echo "Please fill in all the data. You've mised the following fields: <br>";
        if (empty($_POST['currentpass']))
        {
          echo 'Current password <br>';
        }
        if (empty($_POST['newpass']))
        {
          echo 'Password</br>';
        }
        if (empty($_POST['newpass2']))
        {
          echo 'Re-entered password';
        }
    }
}
if (isset($_POST['page']) && $_POST['page'] === 'changename')
{
  echo '<form action="" method="post">
  <div>
  Change your username below: <br><br>
  <input type="password" name="currentpass"><br>
  <input type="text" name="username"><br>
  <input type="submit" value="Change username"><br>
  </div>
  </form>';

  if (!empty($_POST['currentpass']) && !empty($_POST['username']))
  {
    $currentpass = $_POST['currentpass'];
    $username = $_POST['username'];

    if (password_verify($currentpass, $user->getHashPass()))
    {
      if (is_string($username))
      {
        $user->setUsername($username);
        $user->saveToDB($conn);
        $_SESSION['username'] = $username;
        header('refresh: 1; index.php');
      }
      else
      {
        echo $username. ' is not a valid string. </br>';
      }
    }
    else
    {
      echo "Incorrect current password</br>";
    }
  }
  else
  {
    echo "Please fill in all the data. You've missed the following fields:<br>";
    if (empty($_POST['currentpass']))
    {
      echo "Current password<br>";
    }
    if (empty($_POST['username']))
    {
      echo "username<br>";
    }
  }
}
if (isset($_POST['page']) && $_POST['page'] === 'changemail')
{
  echo '<form action="" method="post">
  <div>
  Change your e-mail below:<br><br>
  <input type="password" name="currentpass"<br>
  <input type="email" name="email"><br>
  <input type="submit" value"Change email"
  </div>
  </form>';

   if(!empty($_POST['currentpass']) && !empty($_POST['email']))
   {
     $currentpass = $_POST['currentpass'];
     $newemail = $_POST['email'];

     if (password_verify($currentpass, $user->getHashPass()))
     {
       if (is_string($newemail))
       {
         if (!in_array($newemail, $emials))
         {
           $user->setEmail($newemail);
           $user->saveToDB($conn);
           $_SESION['useremail'] = $newemail;
           header('refres: 1; index.php');
         }
         else
         {
           echo "We're sorry, but e-mail ".$newemail." is already in use. <br>";
           echo "Try a different one.";
         }
       }
       else
       {
         echo $newemail." is not a valid string. <br>";
       }
     }
     else
     {
       echo "Incorrect current password. <br>";
     }
   }
   else
   {
     echo "Please fill in all the data. You've missed the following fields: <br>";
     if (empty($_POST['currentpass']))
     {
       echo "Current password <br>";
     }
     if (empty($_POST['email']))
     {
       echo "E-mail<br>";
     }
   }
}
?>
