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
    static public function loadAllTweetsByUserID(mysqli $connection, $userId)
    {
        $sql = "SELECT * FROM Tweet WHERE userId = $userId"; 
        $result = $connection->query($sql); 
        $ret = []; 
        
        if ($result == true && $result->num_rows>0)
        {
            foreach ($result as $row)
            {
                $userTweet = new Tweet(); 
                $userTweet->id = $row['id']; 
                $userTweet->userId = $row['userId']; 
                $userTweet->text = $row['text']; 
                $userTweet->creationDate = $row['creationDate']; 
                
                $ret[] = $userTweet; 
            }
        }
        return $ret; 
    }
    static public function loadAllTweets(mysqli $connection)
    {
        $sql = "SELECT * FROM Tweet ORDER BY creationDate DESC";
        $return = []; 
        $result = $connection->query($sql); 
        
        if ($result == true && $result->num_rows>0)
        {
            foreach ($result as $row)
            {
                $allTweets = new Tweet(); 
                $allTweets->id = $row['id']; 
                $allTweets->userId = $row['id']; 
                $allTweets->text = $row['text']; 
                $allTweets->creationDate = $row['creationDate']; 
                
                $return[] = $allTweets; 
            }
        }
        return $return; 
    }
}