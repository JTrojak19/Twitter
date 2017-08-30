<?php
/**
 * Created by PhpStorm.
 * User: joanna
 * Date: 23.08.17
 * Time: 18:05
 */
session_start();
include "config.php";
include "class/User.php";
include 'class/Tweet.php';
include "class/Comment.php"; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Twitter App</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Main</a></li>
            <li><a href="register.php">Messages</a></li>
            <li><a href="login.php">Settings</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    
    <?php
    echo "<h2>";
    echo "Witaj na stronie głównej, ";
    echo $_SESSION['username'];
    echo "</h2>";
    ?>
    <form>
         <div class="form-group">
            <label for="comment">Tweet</label>
            <textarea class="form-control" rows="3" id="tweet"></textarea>
            <button type="submit" class="btn btn-default">Submit</button>
        </div> 
    </form>
    <?php
    $allTweets = new Tweet(); 
    $tweets = $allTweets::loadAllTweets($mysqli); 
    $allusers = new User(); 
    $users = $allusers::loadAllUsers($mysqli); 
    $comment = new Comment(); 
    
    
    echo "<table>";
    for ($i = 0; $i<count($tweets); $i++)
    {
         echo "<tr>";
         echo "<th>"; 
         $postId = $tweets[$i]->getId(); 
         $userId = $tweets[$i]->getUserId();
         echo $allusers::loadUserById($mysqli, $userId)->getUsername(); 
         echo "</th>"; 
         echo "</tr>"; 
         echo "<tr>"; 
         echo "<td>"; 
         echo $tweets[$i]->getText(); 
         echo "</td>"; 
         echo "<td>"; 
         echo $tweets[$i]->getCreationDate(); 
         echo "</td>"; 
         echo "</tr>";
         echo "<tr>"; 
         $comments = $comment::loadCommentsByPostId($mysqli, $postId); 
         foreach ($comments as $comment) {
             echo "<td>"; 
             $userId = $comment->getUserId(); 
             echo $allusers::loadUserById($mysqli, $userId)->getUsername(); 
             echo "</td>"; 
             echo "<td>"; 
             echo $comment->getText(); 
             echo "<td>"; 
             echo $comment->getCreationDate(); 
             echo "</td>"; 
         }
         echo "</tr>"; 
    }
    echo "</table>"; 
    echo "<hr>"; 
    ?>
</div>
</body>
</html>
