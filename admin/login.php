<?php
session_start();
require('../includes/config.php');
require('../includes/general.functions.php');
require('../includes/users.class.php');

if(checkLogin()){
    header("LOCATION:index.php");
    exit();
}

$error="";
$success="";

if(count($_POST)>0)
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $encryptpass=md5($password);

    $users = new users();
    $userData = $users->login($username,$encryptpass);
    if($userData && count($userData)>0)
    {
        $_SESSION['user'] = $userData;
        $success="Login sucessfully";
        header("Refresh:0.5; url=index.php");

    }
    else
    {
        $error="Invalid Username and Password";
    }


}

include("../templates/login.html");
?>
