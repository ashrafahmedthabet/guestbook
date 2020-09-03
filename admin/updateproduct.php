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
$productsdata=new products();
$id=(isset($_GET['id'])) ? (int)$_GET['id']:0;
    $error="";
$success="";
    if(count($product)==0){
        echo"<div class='admin-panel__content'>
        <div class='alert alert-danger'>
        <p>product not found</p>
    </div></div>";
    exit();
    }
    if(count($_POST)>0){
    $title=$_POST['title'];
    $desc=$_POST['desc'];
    $img=$product["image"];
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
                $imgname=md5($name.rand(10,1000)).$name;
                //move to upload
                if(move_uploaded_file($tmp,'../uploads/'.$imgname)){
                    if(file_exists("../uploads/".$product["image"])){
                        unlink("../uploads/".$product["image"]);
                    }
                }
                $img=$imgname;
            }
        }
    if($productsdata->updateProduct($id,$title,$desc,$img,$price,$available)){
        $success="Product updated successfully";
    }
    else{
        $error.="product not updated";
    }
    $product=$productsdata->getProduct($id);

}
else{
    $product=$productsdata->getProduct($id);

}
include('../templates/admin/update-product.html');
include("../templates/admin/footer.html");

ob_flush();


?>