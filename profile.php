<?php
session_start(); 
include 'config.php';
include 'class/User.php';
include 'class/Tweet.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
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
            <li><a href="main.php">Main</a></li>
            <li><a href="messages.php">Messages</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li class="active"><a href="#">Profile</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>
</nav>
        <div class="container">
            <?php
            $userEmail = $_SESSION['username']; 
            $userId = $_SESSION['userId']; 
            echo "<h2>"; 
            echo $userEmail; 
            echo "</h2>"; 
            
            $tweets = new Tweet(); 
            $allUserTweets = $tweets::loadTweetsByUserId($mysqli, $userId); 
            $user = new User(); 
            echo "<table>"; 
            for ($i = 0; $i<count($allUserTweets); $i++)
            {
                echo "<tr>"; 
                echo "<th>";
                echo $user::loadUserById($mysqli, $userId)->getUsername(); 
                echo "</th>"; 
                echo "</tr>";
                echo "<tr>"; 
                echo "<td>"; 
                echo $allUserTweets[$i]->getText(); 
                echo "</td>"; 
                echo "<td>"; 
                echo $allUserTweets[$i]->getCreationDate(); 
                echo "</td>"; 
                echo "</tr>"; 
            }
            echo "</table>"; 
            ?>
        </div>   
    </body>
</html>
