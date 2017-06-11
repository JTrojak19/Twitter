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
        $this->userId = 0; 
        $this->text = ""; 
        $this->creationDate = 0; 
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
    
}