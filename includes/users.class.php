<?php
class users
{
    private $connection;

    // create connection 
    public function __construct()
    {
        $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    // add new user

    public function addUser($fullname,$username,$password,$email)
    {
        $stmt = $this->connection->prepare("INSERT INTO users (fullname,username,password, email) VALUES (?,?,?,?)");
        $stmt->execute(array($fullname,$username, $password, $email));
        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }


    //update user

    public function updateUser($id,$fullname, $username,$email,$password)
    {
      
        $stmt = $this->connection->prepare("UPDATE users SET fullname=?,username=?,email=?,password=? WHERE id=?");
                
        $stmt->execute(array($fullname,$username, $email,$password, $id));

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }

    // delete user

    public function deleteUser($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE id= ? ");
        $stmt->execute(array($id));
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }


    // get all users
    public function getUsers($extra = '')
    {
        $stmt = $this->connection->prepare("SELECT * FROM users $extra");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        
            $users = $stmt->fetchAll();
            return $users;
         }
        return null;
    }

    // get user by id

    public function getUser($id)
    {
        $stmt=$this->connection->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
        $stmt->execute(array($id));
        if($stmt->rowCount()>0){
            $user=$stmt->fetch();
            return $user;
        }
        return null;
    }

    // login 
    public function login($username, $password)
    {
        $stmt=$this->connection->prepare("SELECT * FROM users WHERE username=? AND password=? LIMIT 1");
        $stmt->execute(array($username,$password));
        if($stmt->rowCount()>0){
            $user=$stmt->fetch();
            return $user;
        }
        return null;

        
    }


    /**
     * close connection
     */
    public function __destruct()
    {
        $this->connection = null;
    }
}
