<?php
ob_start();
session_start();
require("../includes/config.php");
require("../includes/general.functions.php");
require("../includes/messages.class.php");

if(!checkLogin()){
    exit("Can not access this page ");
}
include("../templates/admin/header.html");
include("sidebar.php");
$messagesdata=new messages();
$id=(isset($_GET['id'])) ? (int)$_GET['id']:0;
if($messagesdata->deleteMessage($id)){    
       echo"<div class='admin-panel__content'>
        <div class='alert alert-success'>
            <p>message deleted</p>
        </div></div>";
   }
else{
    echo"<div class='admin-panel__content'>
    <div class='alert alert-danger'>
    <p>message not deleted</p>
</div></div>";
}
include("../templates/admin/footer.html");

ob_flush();


?>