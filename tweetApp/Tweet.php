<?php

class Tweet 
{
    private $id; 
    private $userId; 
    private $text;
    private $creationDate; 
    
    public function __construct()
    {
        $this->id = -1; 
        $this->userId = ""; 
        $this->text = ""; 
        $this->creationDate = ""; 
    }
    
    public function setText($text)
    {
        $this->text = $text; 
    }
    public function getText()
    {
        return $this->text; 
    }
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate; 
    }
    public function getCreationDate($creationDate)
    {
        return $this->creationDate; 
    }
    public function getId()
    {
        return $this->id; 
    }
    public function getuserId()
    {
        return $this->userId; 
    }
    static public function loadTweetById(mysqli $connection, $id)
    {
       $sql = "SELECT * FROM Tweet WHERE id=$id"; 
       $result = $connection->query($sql); 
       
       if ($result==true && $result->num_rows == 1)
       {
           $row = $result->fetch_assoc(); 
           $loadedTweet = new Tweet(); 
           $loadedTweet->id = $row['id']; 
           $loadedTweet->userId = $row['userId']; 
           $loadedTweet->text = $row['text']; 
           $loadedTweet->creationDate = $row['creationDate']; 
           return $loadedTweet; 
       }
       return null; 
    }
}