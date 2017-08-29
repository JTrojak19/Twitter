<?php
class Comment 
{
    private $id; 
    private $userId; 
    private $postId; 
    private $creationDate; 
    private $text; 
    
    public function __construct() {
        $this->id = -1;
        $this->userId = ""; 
        $this->postId = ""; 
        $this->creationDate = ""; 
        $this->text = ""; 
    }
    public function getId() {
        return $this->id; 
    }
    public function getUserId() {
        return $this->userId; 
    }
    public function setUserId($userId) {
        $this->userId = $userId; 
    }
    public function getPostId() {
        return $this->postId; 
    }
    public function setPostId($postId) {
        $this->postId = $postId; 
    }
    public function getCreationDate() {
        return $this->creationDate; 
    }
    public function setCreationDate($creationDate){
        $this->creationDate = $creationDate; 
    }
    public function getText() {
        return $this->text; 
    }
    public function setText($text) {
        $this->text = $text; 
    }
    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {
            
            $sql = "INSERT INTO Comments(userId, postId, creationDate, text) VALUES('$this->userId', '$this->postId', $this->creationDate, '$this->text')";
            
            $result = $connection->query($sql); 
            
            if ($result == true){
                $this->id = $connection->insert_id; 
                return true; 
            }
            return false;
        }
    }
    static public function loadCommentsByUserId(mysqli $connection, $userId) {
        $sql = "SELECT * FROM Comments WHERE userId = $userId"; 
        $result = $connection->query($sql);
        $ret = []; 
        if ($result == true && $result->num_rows > 0) {
            foreach ($result as $row) { 
            $loadComment = new Comment(); 
            $loadComment->id = $row['id']; 
            $loadComment->userId = $row['userId']; 
            $loadComment->postId = $row['postId']; 
            $loadComment->creationDate = $row['creationDate']; 
            $loadComment->text = $row['text']; 
            
            $ret[] = $loadComment; 
            }
            return $ret; 
        }
        return null; 
    }
    static public function loadCommentsByPostId(mysqli $connection, $postId) {
        $sql = "SELECT * FROM Comments WHERE postId = $postId"; 
        $result = $connection->query($sql); 
        $ret = []; 
        if ($result == true && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadComment = new Comment(); 
                $loadComment->id = $row['id']; 
                $loadComment->userId = $row['userId']; 
                $loadComment->postId = $row['postId']; 
                $loadComment->creationDate = $row['creationDate']; 
                $loadComment->text = $row['text']; 
                
                $ret[] = $loadComment; 
            }
            return $ret;
        }
        return null; 
    }
}

