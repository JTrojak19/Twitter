<?php
/**
 * Created by PhpStorm.
 * User: joanna
 * Date: 22.08.17
 * Time: 11:08
 */
$mysqli = new mysqli('localhost', 'root', 'coderslab', 'Twitter');
if ($mysqli->connect_error)
{
    echo "Connection error". mysqli_connect_error();
}
