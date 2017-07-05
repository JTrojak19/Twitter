<?php
require_once 'User.php';
require_once 'Tweet.php';
require_once 'Comment.php';

if (isset($_SESSION['useremail']))
{
  $email - $_SESSION['useremail'];
  $userId = $_SESSION['userId'];
}
?>

<html>
<body>
  <p>Find all the latest tweets here!</p>
  <form action="" method="post">
    <textarea name="tweetcontent" rows="3" cols="50"</textarea></br><br>
      <input type="submit" value="Tweet"</button>
  </form>
</body>
</html>

<?php
 if (isset($_POST['tweetcontent']) && is_string($_POST['tweetcontent']))
 {
   if (strlen($_POST['tweetcontent']) > 0)
   {
     $tweetcontent = $_POST['tweetcontent'];
     $tweet = new Tweet();
     $tweet->setUserId($userId);
     $tweet->setCreationDate(date('Y-m-d h:i:s'));
     $tweet->setText($tweetcontent);
     $tweet->saveToDB($conn);
   }
 }

 if (isset($_POST['tweetcomment']) && is_string($_POST['tweetcomment']) && isset($_POST['tweetId']) && is_numeric($_POST['tweetId']))
 {
   if (strlen($_POST['tweetcomment']) > 0)
   {
     $commentcontent = $_POST['tweetcomment'];
     $tweetId = $_POST['tweetId'];
     $comment = new Comment();
     $comment->setUserId($userId);
     $comment->setTweetId($tweetId);
     $comment->setCreationDate(date('Y-m-d h:i:s'));
     $comment->setText($commentcontent);
     $comment->saveToDB($conn);
   }
 }
 $allTweets = Tweet::loadAllTweets($conn);
 $reversedTweets = array_reverse($allTweets);

 echo '<table>';
 foreach ($reversedTweets as $tweet)
 {
   echo "<tr><td>".$tweet->getUsername(). $tweet->getCreationDate(). $tweet->getText()."</td></tr>";
   echo "<tr><td>
   <form action='' method='post'>
   <textarea name='tweetcomment'></textarea>
   <input type='text' name='tweetId' value='.$tweet->getId()'
   <input type='submit' value='send'>
   </form>
   </td>
   </tr>";
   $allComments = comment::loadCommentsByTweetId($conn, $tweet->getId());
   $allCommentsReveserd = array_reverse($allComments);
   foreach ($allCommentsReveserd as $comment)
   {
     $commentUser = User::loadUserById($conn, $comment->getUserId());
     echo "<tr>";
     echo "<td>".$commentUser->getUsername().$commentUser->getEmail().$comment->getCreationDate().$comment->getText()."</td>";
     echo "</tr>";
   }
 }
 echo "</table>"; 
 ?>
