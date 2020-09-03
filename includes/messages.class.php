<?php

class messages {

    private $connection;

    // create connection 
    public function __construct()
    {
        $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    // add new message

    public function addMessage($title,$content,$name,$email)
    {
        $stmt=$this->connection->prepare("INSERT INTO messages(title, content, name, email) VALUES (?,?,?,?)");
        $stmt->execute(array($title,$content,$name,$email));
        if($stmt->rowCount()>0){
            return true;
        }
        return false;
    }

    // update message
     
    public function updateMessage($id,$title,$content)
    {
       $stmt=$this->connection->prepare("UPDATE messages SET title=?,content=?WHERE id=?");
        $stmt->execute(array($title,$content,$id));
        if($stmt->rowCount() >0)
            return true;

        return false;
    }


    //delete message
     
    public function deleteMessage($id)
    {
        $stmt=$this->connection->prepare("DELETE FROM `messages` WHERE id=?");

        $stmt->execute(array($id));
        if($stmt->rowCount() >0)
            return true;

        return false;
    }

    // fetch all messages
     
    public function getMessages($extra='')
    {
        $stmt = $this->connection->prepare("SELECT * FROM messages  $extra");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $messages;
        }
        return null;
    }


    // get message by id
     
    public function getMessage($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM messages WHERE id=? LIMIT 1");
        $stmt->execute(array($id));
        if ($stmt->rowCount() > 0) {
            $message = $stmt->fetch(PDO::FETCH_ASSOC);
            return $message;
        }
        return null;        
    }


    // close connection
    public function __destruct()
    {
        $this->connection=null;
    }



}