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
$error='';
$success='';
$messagesdata=new messages();
$id=(isset($_GET['id'])) ? (int)$_GET['id']:0;
if(count($_POST)>0){
    $title=$_POST['title'];
    $content=$_POST['content'];
    
    if($messagesdata->updateMessage($id,$title,$content)){
        $success='Message updated successfully...';
    }     
    else{
        $error="Message not updated";
    }
    $message=$messagesdata->getMessage($id);

   }
else{
    $message=$messagesdata->getMessage($id);
    
}
include("../templates/admin/update-message.html");
include("../templates/admin/footer.html");


ob_flush();


?>