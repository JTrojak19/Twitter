<?php
require_once 'index.php';
echo '<h3>'.$_SESSION['username']. ' witaj na stronie głównej!</h3>'; 
require_once 'Tweet.php';
?>
<html>
    <body>
        <form action="index.php" method="post">
            <input type="submit" name="logOut" value="Log Out">
        </form>
        <br>
        <br>
        <h1>Tweetnij</h1>
        <form action="" method="post">
            <textarea name="tweet" rows="3" cols="50"></textarea>
            <br>
            <br>
            <input type="submit" value="Tweet">
        </form>
    </body>
    <?php
    include_once 'db_conn.php';
    include_once 'Tweet.php';
    $userId = $_SESSION['userId']; 
    $newText = ''; 
    
    if (isset($_POST['tweet']))
    {
        $newText = $_POST['tweet']; 
        //var_dump($newText); 
        
        $date = time(); 
        $Tweet = new Tweet; 
        $Tweet->setText($newText); 
        $Tweet->setCreationDate($date); 
        $Tweet->setUserId($userId); 
        //var_dump($Tweet); 
        $Tweet->saveToDB($mysqli); 
    }
    ?>
</html>