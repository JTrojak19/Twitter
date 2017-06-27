<!DCCTYPE html> 
<html>
    <head>
        
    </head>
    <body>
        <?php
        if (!isset($_SESSION['username']))
        {
            echo "You are not logged!"; 
            echo "<form action='' method='get'><button type='submit' name='page' value='login'>Login</button><button type='submit' name='page' value='register'>Register</button></form>"; 
        }
        else 
        {
            echo $_SESSION['username']; 
            echo "<br>"; 
            echo "<form action='' method='get'>"; 
            echo "<button type='submit' name='page' value='logout'>Logout</button>"; 
            
            if (isset($_GET['page']) && isset($_GET['page']) === 'profile')
            {
                echo "<button type='submit' value=''>Tweeets</button>"; 
            }
            else 
            {
                echo "<button type='submit' name='page' value='profile'>Profile</button>"; 
            }
            echo "<br>"; 
            
            if (isset($_GET['page']) && isset($_GET['page']) === 'messages')
            {
                echo "<button type='submit' value=''>Tweets</button>"; 
            }
            else 
            {
                echo "<button type='submit' name='page' value='messages'>Messages</button>"; 
            }
            echo "</form>"; 
        }
        ?>
    </body>
</html>