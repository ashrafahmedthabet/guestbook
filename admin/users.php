<?php
ob_start();
session_start();
require("../includes/config.php");
require("../includes/general.functions.php");
require("../includes/users.class.php");

if(!checkLogin()){
    exit("Can not access this page ");
}
include("../templates/admin/header.html");
include("sidebar.php");
$usersdata=new users();

$allusers=$usersdata->getUsers();


include('../templates/admin/all-users.html');
include("../templates/admin/footer.html");
ob_flush();


?>