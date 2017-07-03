<?php
require_once 'User.php';
require_once 'Messages.php';

if (isset($_SESSION['useremail']))
{
  $email = $_SESSION['useremail'];
  $userId = $_SESSION['userId'];
}
$allUsers = User::loadAllUsers($conn);
 ?>
 <html>
 <body>
   <p>Write your private messages here</p>
   <br>
   <form action="" method="post">
     <textarea id="tweet" name="messagecontent" rows="3" cols="50" maxlength="140"></textarea><br>
     <select name="receiver">
       <?php
       echo '<option>Pick Your receiver</option>';
       for ($i = 0; $i<count($allUsers); $i++)
       {
         if ($allUsers[$i]->getUserid() !==$userId)
         {
           echo '<option value=""'.allUsers[$i]->getUserid().'">'.$allUsers[$i]->getUsername().' ('.$allUsers[$i]->getEmail().')</option>';
         }
       }
        ?>
      </select><br><br>
      <input type="submit" value="Send">
   </form>
 </body>
 </html>
