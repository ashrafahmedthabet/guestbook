<?php
ob_start();

session_start();
require("../includes/config.php");
require("../includes/general.functions.php");
require("../includes/messages.class.php");

if(!checkLogin()){
    exit("Can not access this page");
}
include("../templates/admin/header.html");
include("sidebar.php");

$messagedata=new messages();

$allmessage=$messagedata->getMessages();

include('../templates/admin/all-messages.html');
include("../templates/admin/footer.html");

ob_flush();


?>