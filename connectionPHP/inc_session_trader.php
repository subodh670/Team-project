<?php

// echo "HELLO";
session_start();
// echo $_SESSION['traderusername'];
// echo $_SESSION['traderpassword'];
// echo $_SESSION['traderapproval'];
include("../connectionPHP/connect.php");
$username = $_SESSION['traderusername'];
$sql = "SELECT STATUS FROM MART_USER WHERE USERNAME = '$username'";
$arr = oci_parse($conn, $sql);
oci_execute($arr);
$status = oci_fetch_array($arr)[0];
if(!isset($_SESSION['traderusername']) || !isset($_SESSION['traderpassword']) || $status==2 || $status == 0){
    // echo "HELLO";
    header("location: ../traders_login_page/index.php");
}


?>