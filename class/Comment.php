<?php
$mysqli = new mysqli('localhost', 'root', 'coderslab', 'Twitter');
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
    
}
$comment = new Comment(); 
$date = 'NOW()'; 
$comment->setUserId(1); 
$comment->setPostId(1); 
$comment->setCreationDate($date); 
$comment->setText('some text'); 
var_dump($comment->saveToDB($mysqli)); 
