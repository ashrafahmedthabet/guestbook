<?php
require('includes/config.php');
require('includes/products.class.php');
$id =(isset($_GET['id']))? (int) $_GET['id']:0;
$productdata=new products();
$product=$productdata->getProduct($id);
if($product!=null){
include("templates/product-info.html");
}
else{
    include("templates/404.html");
}


?>
