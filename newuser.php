<?php
require_once "User.php";

echo '<form action="" method="post">
<input type="email" name="email"><br>
<input type="text" name="username"<br>
<input type="password" name="pass"<br>
<input type="password" name="pass2"<br>
<input type="submit value="Register">
</form>';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['pass']) !empty($_POST['pass2']))
  {
    $email = $_POST['email'];
    $name = $_POST['username'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];

    if ($pass === $pass2)
    {
      $hashedPass = password_hash($pass, PASSWORD_BYCRYP);
      $newUser = new User();
      $newUser->setEmail($email);
      $newUser->setUsername($name);
      $newUser->setHashPass($hashedPass);
      $newUser->saveToDB($conn);
    }
    else
    {
      echo "Passwords are not identical !!<br>";
    }
  }
  else
  {
    echo "Please fill in all the data. You've missed the following fields:<br>";
    if (empty($_POST['email']))
    {
      echo "Email<br>";
    }
    if (empty($_POST['username']))
    {
      echo "Username<br>";
    }
    if (empty($_POST['pass']))
    {
      echo "Password<br>";
    }
    if (empty($_POST['pass2']))
    {
      echo "Re-entered password";
    }
  }
}
?>
