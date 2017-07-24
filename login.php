<?php
require_once 'User.php';

echo '<form action="" method="post">
<input type="email" name="email"><br>
<input type="password" name="password"><br><br>
<input type="submit" value="Log In">
</form>';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  if (!empty($_POST['email']) && !empty($_POST['password']))
  {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = User::loadUserByEmail($conn, $email);

    if (password_verify($password, $user->getHashPass()))
    {
      $_SESSION['username'] = $user->getUsername();
      $_SESSION['useremail'] = $user->getUsername();
      $_SESSION['userId'] = $user->getUserid();
      header('refresh: 1; index.php');
    }
    else
    {
      echo "Incorrect password or e-mail<br>";
    }
  }
  else
  {
    echo "Please fill in all the data/ You've missed the following fields:<br>";
    if (empty($_POST['email']))
    {
      echo "Email address<br>";
    }
    if (empty($_POST['password']))
    {
      echo "Password<br>";
    }
  }
}
?>
