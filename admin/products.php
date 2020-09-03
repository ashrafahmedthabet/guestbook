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

$allproducts=$productsdata->getProducts();

include('../templates/admin/all-products.html');
include("../templates/admin/footer.html");

ob_flush();


?>