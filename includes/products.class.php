<?php

class products
{

    private $connection;

    /*
     * create new connection
     */
    public function __construct()
    {
        $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    // add new product
  
    public function addProduct($title,$description,$image,$price,$available,$userId)
    {
        $stmt=$this->connection->prepare("INSERT INTO products (title, description, image, price, available, user_id) VALUES (?,?,?,?,?,?)");
        $stmt->execute(array($title,$description,$image,$price,$available,$userId));
        if($stmt->rowCount()>0){
            return true;
        }
        return false;
      
    }

    // update product
     
    public function updateProduct($id,$title,$description,$image,$price,$available)
    {
        $stmt=$this->connection->prepare("UPDATE products SET title= ?, description=?, image=?, price=?, available=? WHERE id=?");

        $stmt->execute(array($title,$description,$image,$price,$available,$id));
        if($stmt->rowCount()>0)
            return true;

        return false;
    }


    // delete product
    
    public function deleteProduct($id)
    {
       $stmt= $this->connection->prepare("DELETE FROM products WHERE id=?");
        $stmt->execute(array($id));
        if($stmt->rowCount()>0)
        return true;

    return false;
    }
    public function getProducts($extra='')
    {
        $stmt = $this->connection->prepare("SELECT * FROM products $extra");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        }
        return null;
    }


    // get product by id
    
    public function getProduct($id)
    {
        $stmt=$this->connection->prepare("SELECT * FROM products WHERE id=? LIMIT 1");
        $stmt->execute(array($id));
        if($stmt->rowCount()>0){
            $product=$stmt->fetch();
            return $product;
        }
        return null;    }

    // search for product
    
    public function searchProduct($keyword)
    {
        return $this->getProducts("WHERE title LIKE '%$keyword%'");
    }

    /**
     * close connection
     */
    public function __destruct()
    {
        $this->connection=null;
    }
}