<?php
echo '<h3>'.$_SESSION['username']. ' witaj na stronie głównej!</h3>'; 
require_once 'Tweet.php';
?>
<html>
    <body>
        <form action="index.php" method="post">
            <button type="submit" name="logOut">Wyloguj się</button>
        </form>
        <h1>Tweetnij</h1>
        <form action="" method="post">
            <textarea name="tweet" rows="3" cols="50"></textarea>
            <br>
            <br>
            <input type="submit" value="Tweet">
        </form>
    </body>
    <?php
    $userId = $_SESSION['userId']; 
    $newText = ''; 
    
    if (isset($_POST['tweet']))
    {
        $newText = $_POST['tweet']; 
        $sql = "SELECT text FROM Posts WHERE userI=$userId"; 
        $result = $mysqli->query($sql); 
        
        if ($result == true && $result->num_rows > 0)
        {
            if ($row=$result->fetch_assoc())
            {
                if ($row['text'] != $newText && $newText != "")
                {
                    $date = "NOW()"; 
                    $newTweet = new Tweet(); 
                    $newTweet->setText($newText);
                    $newTweet->setCreationDate($date); 
                    $newTweet->setUserId($userId); 
                    $newTweet->saveToDB($mysqli); 
                }
                
            }
            else if ($result->num_rows == null)
            {
                if ($newText != "")
                {
                    $date = "NOW()"; 
                    $newTweet = new Tweet(); 
                    $newTweet->setText($newText);
                    $newTweet->setCreationDate($date); 
                    $newTweet->setUserId($userId); 
                    $newTweet->saveToDB($mysqli);
                }
            }
        }
    }
    ?>
</html>