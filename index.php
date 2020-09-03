<?php
require('includes/config.php');
require('includes/products.class.php');

$productdata=new products();
$allproduct=$productdata->getProducts("ORDER BY id DESC LIMIT 3");

include("templates/index.html");



?>
