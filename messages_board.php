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
           echo "<option value''"; 
           echo $loadedUser->getUsername(); 
           echo "</option>"; 
         }
       }
        ?>
      </select><br><br>
      <input type="submit" value="Send">
   </form>
   <form action="" method="post">
     <p>Check your inbox or sent a message:</p>
     <button type="submit" name="page" value="inbox">Inbox</button>
     <button type="submit" name="page" value="send">Send your message</button>
   </form>
 </body>
 </html>
 <?php
 if (isset($_POST['messagecontent']) && is_string($_POST['messagecontent']))
 {
   if (strlen($_POST['messagecontent']) <= 0 || !isset($_POST['receiver']))
   {
     if (strlen($_POST['messagecontent']) <= 0)
     {
       echo "Your message is too short</br>";
     }
     else
     {
       echo "Pick your receiver, please";
     }
   }
   else
   {
     $messagecontent = $_POST['messagecontent'];
     $receiver = $_POST['receiver'];
     $message = new Message();
     $message->setSenderId($userId);
     $message->setReceiverId($receiver);
     $messsage->setCreationDate(date('Y-m-d H:i:s'));
     $message->setText($messagecontent);
     $message->saveToDB($conn);
   }
 }
 if (isset($_POST['page']) && $_POST['page'] === 'inbox')
 {
   echo "Your inbox:</br>";
   $myMessages = Message::loadMessagesByReciver($conn, $userId);
   if (count($myMessages) == 0)
   {
     echo "You have 0 messages";
   }
   else
   {
     $recivedMessagesRev = array_reverse($myMessages);
     echo "<table>";
     foreach ($receivedMessagesRev as $message)
     {
       echo "<tr>
       <td>Status:".$message->getMesssageStatus($conn) . $message->getCreationDate() . $message->getText()."</td
       </tr>";
       $message->setStatus(1);
       $message->setMessageStatus($conn);
     }
     echo "</table>";
   }
 }
 if (isset($_POST['page']) && $_POST['page'] === 'send')
 {
   echo "Here you can see messages your have sent:";
   $myMessages = Message::loadMessagesBySender($conn, $userId);
   if (count($myMessages) == 0)
   {
     echo "You haven't sent any messages yet";
   }
   else
   {
     $sendMessagesRev = array_reverse($myMessages);
     echo "<table>";
     echo "<tr><td>Status: ".$message->getMessageStatus($conn).$messsage->getCreationDate(). $message->getText()."</td>
     </tr>"; 
   }
   echo "</table>";
 }
  ?>
