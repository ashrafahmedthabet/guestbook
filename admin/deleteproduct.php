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
$product=$productsdata->getProduct($id);

if($productsdata->deleteProduct($id)){    
       echo"<div class='admin-panel__content'>
        <div class='alert alert-success'>
            <p>product deleted</p>
        </div></div>";
        if(file_exists("../uploads/".$product["image"])){
            unlink("../uploads/".$product["image"]);
        }

   }
else{
    echo"<div class='admin-panel__content'>
    <div class='alert alert-danger'>
    <p>product not deleted</p>
</div></div>";
}
include("../templates/admin/footer.html");

ob_flush();


?>