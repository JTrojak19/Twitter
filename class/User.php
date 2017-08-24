<?php
/**
 * Created by PhpStorm.
 * User: joanna
 * Date: 22.08.17
 * Time: 11:15
 */
//$mysqli = new mysqli('localhost', 'root', 'coderslab', 'Twitter');
class User
{
    private $id;
    private $username;
    private $hashedPassword;
    private $email;

    public function __construct()
    {
        $this->id = -1;
        $this->username = "";
        $this->hashedPassword = "";
        $this->email = "";
    }
    public function getId()
    {
        return $this->id;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setPassword($newPassword)
    {
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
    }
    public function getPassword()
    {
        return $this->hashedPassword;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function saveToDb(mysqli $connection)
    {
        if ($this->id == -1)
        {
            //saving new user to DB
            $sql = "INSERT INTO Users(email, username, hashed_Password) VALUES('$this->email','$this->username', '$this->hashedPassword')";
            $result = $connection->query($sql);

            if ($result == true)
            {
                $this->id = $connection->insert_id;
                return true;
            }
            return false;
        }
        else
        {
            $sql = "UPDATE Users SET email = '$this->email', username = '$this->username'
                      hashed_Password = '$this->hashedPassword'
                      WHERE id = $this->id";
            $result = $connection->query($sql);

            if ($result == true)
            {
                return true;
            }
            return false;
        }
    }
    static public function loadUserById(mysqli $connection, $id)
    {
        $sql = "SELECT FROM Users WHERE id = $id";
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1)
        {
            $row = $result->fetch_assoc();

            $loadUser = new User();
            $loadUser->id = $row['id'];
            $loadUser->email = $row['email'];
            $loadUser->username = $row['username'];
            $loadUser->hashedPassword = $row['hashed_Password'];
            return $loadUser;
        }
        return null;
    }
    static public function loadUserByEmail(mysqli $connection, $email)
    {
        $sql = "SELECT FROM Users WHERE email = $email";
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1)
        {
            $row = $result->fetch_assoc();
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->email = $row['email'];
            $loadedUser->username = $row['email'];
            $loadedUser->hashedPassword = $row['hashed_Password'];
            return $loadedUser;
        }
        return null;
    }
    static public function loadAllUsers(mysqli $connection)
    {
        $sql = "SELECT * FROM Users";
        $ret = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0)
        {
            foreach($result as $row)
            {
                $loadedUser = new User();
                $loadedUser->id  = $row['id'];
                $loadedUser->email = $row['email'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashedPassword = $row['hashed_Password'];

                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }
    public function delete(mysqli $connection)
    {
        if ($this->id != -1)
        {
            $sql = "DELETE FROM Users WHERE id = $this->id";
            $result = $connection->query($sql);
            if ($result == true)
            {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

}
