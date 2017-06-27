<?php
    require_once 'config.php';
    session_start(); 
    
    require_once 'db_conn.php';
    require_once 'User.php';
    require_once 'Tweet.php'; 
    require_once 'Comments.php'; 
    require_once 'Messages.php';
     
    echo "<h1>Welcome to my Twitter App!</h1>"; 
    echo "<p>This app was created in order to mimic Twitter functionality</p>"; 
    
    if (isset($_GET['page']) && isset($_GET['page']) === 'logout')// end session 
    {
        unset($_SESSION['username']); 
        unset($_SESSION['email']); 
        unset($_SESSION['userId']); 
        header('refres: 1; index.php'); 
    }
    
    if (!isset($_SESSION['username']))
    {
        echo "To view Tweets you must be logged in"; 
    }
    else 
    {
        if (isset($_GET['page']) && isset($_GET['page']) === 'profile')
        {
            include 'profile.php'; 
        }
        elseif (isset ($_GET['page']) && isset ($_GET['page']) === 'messages') 
        {
            include 'messagematrix.php';
        }
        else 
        {
            require_once 'tweetmatrix.php';
        }
    }
    
    if (isset($_GET['page']) && isset($_GET['page']) === 'login')
    {
        include 'login.php'; 
    }
    if (isset($_GET['page']) && isset($_GET['page']) === 'register')
    {
        include 'newuser.php'; 
    }
    
    
