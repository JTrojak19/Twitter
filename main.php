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
    
    $allTweets = new Tweet(); 
    $tweets = $allTweets::loadAllTweets($mysqli); 
    echo "<table>";
    for ($i = 0; $i<count($tweets); $i++)
    {
         echo "<tr>";
         echo "<th>"; 
         echo $tweets[$i]->getUserId();
         echo "</th>"; 
         echo "<td>"; 
         echo $tweets[$i]->getText(); 
         echo " ";
         echo "</td>"; 
         echo "<td>"; 
         echo $tweets[$i]->getCreationDate(); 
         echo "</td>"; 
         echo "</tr>"; 
    }
    echo "</table>"; 
    ?>
</div>
</body>
</html>
