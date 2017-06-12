<?php
echo '<h3>'.$_SESSION['username']. ' witaj na stronie głównej!</h3>'; 
require_once 'Tweet.php';
?>
<html>
    <body>
        <h1>Tweetnij</h1>
        <form action="" method="post">
            <textarea name="tweet" rows="3" cols="50"></textarea>
            <br>
            <br>
            <input type="submit" value="Tweet">
        </form>
    </body>
</html>