<?php
ob_start();
session_start();
require("includes/config.php");
require("includes/messages.class.php");

$messagesdata=new messages();
$error='';
$success='';
if(count($_POST)>0){
    $title=$_POST['title'];
    $content=$_POST['content'];
    $name=$_POST['name'];
    $mail=$_POST['email'];
    if($messagesdata->addMessage($title,$content,$name,$mail)){
        $success='Message added successfully...';
    }
    else{
        $error='Message not added ! ';
    }
    $allmessage=$messagesdata->getMessages("ORDER BY id DESC");
}
else{

    $allmessage=$messagesdata->getMessages("ORDER BY id DESC");
}
include('templates/guestbook.html');
ob_flush();


?>