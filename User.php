<?php

class User {
    private $id;
    private $username;
    private $hashedPassword;
    private $email;

    static public function loadUserById(mysqli $connection, $id){
        $sql = "SELECT * FROM Users WHERE id=$id";
        $result = $connection->query($sql);
        if($result == true && $result->num_rows == 1){
            $row = $result->fetch_assoc();
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_Password'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }
        return null;
    }
    static public function loadAllUsers(mysqli $connection){
        $sql = "SELECT * FROM Users";
        $ret = array();
        $result = $connection->query($sql);
        if($result == true && $result->num_rows != 0){
            foreach($result as $row){
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashedPassword = $row['hashed_Password'];
                $loadedUser->email = $row['email'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }
    public function __construct(){
        $this->id = -1;
        $this->username="";
        $this->hashedPassword="";
        $this->email="";
    }
    public function saveToDB($connection){
        if($this->id==-1){
            if($this->id == -1){
            $sql = "INSERT INTO Users(username, email, hashed_Password)
                VALUES ('$this->username', '$this->email', '$this->hashedPassword')";
            $result = $connection->query($sql);
            if($result == true){
                $this->id = $connection->insert_id;
                return true;
                }
            }
            return false;
        } else {
            $sql = "
                UPDATE Users SET
                    username='$this->username',
                    email='$this->email',
                    hashed_Password='$this->hashedPassword'
                WHERE
                    id=$this->id";
            $result = $connection->query($sql);
            if($result == true){
                return true;
            }
        }
    }
    public function setUsername($newUsername){
        $this->username=$newUsername;
    }
    public function setEmail($newEmail){
        $this->email=$newEmail;
    }
    public function setPassword($newPassword){
        $this->hashedPassword =
            password_hash($newPassword, PASSWORD_BCRYPT);
    }
    public function getUsername(){
        return $this->username;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getId(){
        return $this->id;
    }
    public function delete(mysqli $connection){
        if($this->id != -1){
            $sql = "DELETE FROM Users WHERE id=$this->id";
            $result = $connection->query($sql);
            if($result == true){
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }
}
?>
