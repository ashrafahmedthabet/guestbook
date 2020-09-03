<?php
require('includes/config.php');
require('includes/products.class.php');

$productdata=new products();
$allproduct=$productdata->getProducts();
include("templates/products.html");


?>
