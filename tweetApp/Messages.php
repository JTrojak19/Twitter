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
    
    static public function loadMessagesBySender(mysqli $connection, $senderId)
    {
        $sql = "SELECT * FROM Messages WHERE senderId=$senderId"; 
        $messages = []; 
        $result = $connection->query($sql); 
        
        if ($result == true && $result->num_rows> 0)
        {
            foreach ($result as $row)
            {
                $loadedMessage = new Message(); 
                $loadedMessage->id = $row['id']; 
                $loadedMessage->senderId = $row['senderId']; 
                $loadedMessage->receiverId = $row['receiverId']; 
                $loadedMessage->creationDate = $row['creationDate']; 
                $loadedMessage->text = $row['text']; 
                $loadedMessage->status = $row['status']; 
                $messages[] = $loadedMessage; 
            }
        }
        return $loadedMessage; 
    }
    
    static public function loadMessagesByReceiver(mysqli $connection, $receiverId)
    {
        $sql = "SELECT * FROM Messages WHERE receiverId = $receiverId"; 
        $messages = []; 
        $result = $connection->query($sql); 
        
        if ($result == true && $result->num_rows > 0)
        {
            foreach ($result as $row)
            {
                $loadedMessage = new Message(); 
                $loadedMessage->id = $row['id']; 
                $loadedMessage->senderId = $row['senderId']; 
                $loadedMessage->receiverId = $row['receiverId']; 
                $loadedMessage->creationDate = $row['creationDate']; 
                $loadedMessage->text = $row['text']; 
                $loadedMessage->status = $row['status']; 
                $messages[] = $loadedMessage; 
            }
        }
        return $result; 
    }
    public function saveToDB($connection)
    {
        if ($this->id = -1)
        {
            $sql = "INSERT INTO Messeges(senderId, receiverId, creationDate, text, status) VALUES ('$this->senderId', '$this->receiv            erId' '$this->creationDate', '$this->text', '$this->status')"; 
            $result = $connection->query($sql); 
            if ($result == true)
            {
                $this->id = $connection->insert_id; 
                return true; 
            }
            else 
            {
                return false; 
            }
        }
    }
    
}