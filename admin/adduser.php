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
$error="";
$success="";
if(count($_POST)>0){
    $usersdata=new users();
    $fname=$_POST["fullname"];
    $username=$_POST["username"];
    $email=$_POST["email"];
    $email=filter_var($email,FILTER_SANITIZE_EMAIL);
    $password=$_POST["password"];
    $confirmpass=$_POST["confirm-password"];
    if($password==$confirmpass){
        $password=md5($password);
          if($usersdata->addUser($fname,$username,$password,$email)){
            $success="User added successfully";
         }
         else{
             $error="user not inserted ";
         }
}
else{
    $error.="password do not matching with confirm password";
}

}

include('../templates/admin/add-user.html');
include("../templates/admin/footer.html");

ob_flush();


?>