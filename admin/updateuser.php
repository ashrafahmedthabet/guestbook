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
$error="";
$success="";
if(count($_POST)>0){
    $fname=$_POST["fullname"];
    $username=$_POST["username"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $encryptpassword=md5($password);
    $password=(strlen($password)>0)?$encryptpassword:$_SESSION["password"];
          if($usersdata->updateUser($id,$fname,$username,$email,$password)){
            $success="User updated successfully";
         }
         else{
             $error="user not updated ";
         }
         $user=$usersdata->getUser($id);

}
else{
    $user=$usersdata->getUser($id);

}

include("../templates/admin/update-users.html");
include("../templates/admin/footer.html");

ob_flush();


?>