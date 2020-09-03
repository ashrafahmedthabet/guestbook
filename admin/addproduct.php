<?php
ob_start();
session_start();
require("../includes/config.php");
require("../includes/general.functions.php");
require("../includes/products.class.php");
if(!checkLogin()){
    exit("Can not access this page ");
}
include("../templates/admin/header.html");
include("sidebar.php");
$error="";
$success="";
$userid=$_SESSION["user"]["id"];
    $productsdata=new products();
    if(count($_POST)>0){
    $title=$_POST['title'];
    $desc=$_POST['desc'];
    $img="";
    $price=$_POST['price'];
    $available=$_POST['availability'];
        if(isset($_FILES['image'])){
            $name=$_FILES['image']['name'];
            $type=$_FILES['image']['type'];
            $tmp=$_FILES['image']['tmp_name'];
            $uploadimg=$_FILES['image']['error'];
            $size=$_FILES['image']['size'];
            if($type=="image/jpg"||$type=="image/jpeg"||$type=="image/png"&&$uploadingerror==0){

                //rename image
                $img=md5($name.rand(10,1000)).$name;

                //move to upload

                move_uploaded_file($tmp,'../uploads/'.$img);
            }
        }
    if($productsdata->addProduct($title,$desc,$img,$price,$available,$userid)){
        $success="Product added successfully";
    }
    else{
        $error="product not added";
    }
}

include('../templates/admin/add-product.html');
include("../templates/admin/footer.html");

ob_flush();


?>