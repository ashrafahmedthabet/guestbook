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
$id=(isset($_GET['id'])) ? (int)$_GET['id']:0;

if($usersdata->deleteUser($id)){    
       echo"<div class='admin-panel__content'>
        <div class='alert alert-success'>
            <p>user deleted</p>
        </div></div>";
   }
else{
    echo"<div class='admin-panel__content'>
    <div class='alert alert-danger'>
    <p>user not deleted</p>
</div></div>";
}
include("../templates/admin/footer.html");
ob_flush();


?>