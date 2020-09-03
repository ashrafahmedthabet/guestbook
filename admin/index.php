<?php
session_start();
require("../includes/general.functions.php");
if(!checkLogin()){
    exit("do not have access this page");

}
include("../templates/admin/header.html");
include("sidebar.php");
include('../templates/admin/index.html');
include("../templates/admin/footer.html");



?>
