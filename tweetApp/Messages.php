<?php 
class Message
{
    private $id; 
    private $senderId; 
    private $receiverId; 
    private $creationDate; 
    private $text;
    private $status; 
    
    public function __construct()
    {
        $this->id = -1; 
        $this->senderId = ""; 
        $this->receiverId = ""; 
        $this->creationDate = ""; 
        $this->text = ""; 
        $this->status = "6"; 
    }
    
    public function getId()
    {
        return $this->id; 
    }
    public function setSenderId($senderId)
    {
        $this->senderId = $senderId; 
    }
    public function getSenderId()
    {
        return $this->senderId; 
    }
    public function setReceiverId($receiverId)
    {
        $this->receiverId = $receiverId; 
    }
    public function getReciverId()
    {
        return $this->receiverId; 
    }
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate; 
    }
    public function getCreationDate()
    {
        return $this->creationDate; 
    }
    public function setText($text)
    {
        $this->text = $text; 
    }
    public function getText()
    {
        return $this->text; 
    }
    public function setStatus($status)
    {
        if (is_numeric($status))
        {
            $this->status = $status; 
        }
    }
    public function getStatus()
    {
        return $this->status; 
    }
    
    
}