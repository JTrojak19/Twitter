<?php
/**
 * Created by PhpStorm.
 * User: joanna
 * Date: 25.08.17
 * Time: 09:41
 */

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
        $this->creationDate = "";
    }
    public function getId()
    {
        return $this->id;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    public function getUserId()
    {
        return $this->userId;
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
    public function getCreationDate()
    {
        return $this->creationDate;
    }
    
}