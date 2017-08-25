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
        $this->userId = "";
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
    public function saveToDb(mysqli $connection)
    {
        if ($this->id == -1)
        {
            $sql = "INSERT INTO Tweets(userId, text, creationDate) VALUES ('$this->userId', '$this->text', $this->creationDate)";
            $result = $connection->query($sql);

            if ($result == true)
            {
                $this->id = $connection->insert_id;
                return true;
            }
            return false;
        }
    }
    static public function loadTweetById(mysqli $connection, $id)
    {
        $sql = "SELECT * FROM Tweets WHERE id = $id";
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1)
        {
            $row = $result->fetch_assoc();
            $loadTweet = new Tweet();
            $loadTweet->id = $row['id'];
            $loadTweet->userId = $row['userId'];
            $loadTweet->text = $row['text'];
            $loadTweet->creationDate = $row['creationDate'];
            return $loadTweet;
        }
        return null;
    }
    static public function loadTweetsByUserId(mysqli $connection, $userId)
    {
        $sql = "SELECT * FROM Tweets WHERE userId = $userId";
        $result = $connection->query($sql);
        $ret = [];

        if ($result == true && $result->num_rows > 0)
        {
            foreach ($result as $row)
            {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];

                $ret[] = $loadedTweet;
            }
            return $ret;
        }
        return null;
    }
    static public function loadAllTweets(mysqli $connection)
    {
        $sql = "SELECT * FROM Tweets";
        $ret = [];
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows > 0)
        {
            foreach ($result as $row)
            {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];

                $ret[] = $loadedTweet;
            }
            return $ret;
        }
        return null;
    }
}


