<?php
class Comment
{
   private $id; 
   private $Id_usera; 
   private $Id_postu; 
   private $Creation_date; 
   private $text; 
   
   public function __construct()
   {
       $this->id = -1; 
       $this->Id_usera = "";
       $this->Id_postu = ""; 
       $this->Creation_date = ""; 
       $this->text = ""; 
   }
   
   public function getId()
   {
       return $this->id; 
   }
   public function setIdusera($Id_usera)
   {
       $this->Id_usera = $Id_usera; 
   }
   public function getIdusera()
   {
       return $this->Id_usera;
   }
   public function setIdpostu($Id_postu)
   {
       $this->Id_postu = $Id_postu; 
   }
   public function getIdpostu()
   {
       return $this->Id_postu; 
   }
   public function setCreation_date($Creation_date)
   {
       $this->Creation_date = $Creation_date; 
   }
   public function getCreation_date()
   {
       return $this->Creation_date; 
   }
   public function setText($text)
   {
       $this->text = $text; 
   }
   public function getText()
   {
       return $this->text; 
   }
   
   static public function loadCommentsById(mysqli $connection, $id)
   {
       $sql = "SELECT * FROM Comments WHERE id=$id"; 
       $result = $connection->query($sql); 
       
       if ($result == true && $result->num_rows == 1)
       {
           $row = $result->fetch_assoc(); 
           $loadedComment = new Comment(); 
           $loadedComment->id = $row['id']; 
           $loadedComment->Id_usera = $row['Id_usera']; 
           $loadedComment->Id_postu = $row['Id_postu']; 
           $loadedComment->Creation_date = $row['Creation_date']; 
           $loadedComment->text = $row['text']; 
           return $loadedComment; 
       }
       return null; 
   }
   static public function loadCommentsByPostId(mysqli $connection, $Id_postu)
   {
       $sql = "SELECT * FROM Comments WHERE Id_postu = $Id_postu"; 
       $result = $connection->query($sql); 
       $ret = []; 
       
       if ($result == true && $result->num_rows > 0)
       {
           foreach ($result as $row)
           {
               $postComment = new Comment(); 
               $postComment->id = $row['id']; 
               $postComment->Id_usera = $row['Id_usera']; 
               $postComment->Id_postu  = $row['Id_postu']; 
               $postComment->Creation_date = $row['Creation_date']; 
               $postComment->text = $row['text']; 
               
               $ret[] = $postComment; 
           }
       }
       return $ret; 
   }
}