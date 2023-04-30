<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $pid = $_GET['pid'];
    $quantity = $_GET['quant'];
    $slot = $_GET['slot'];
    $username = $_GET['username'];
    $query = "SELECT C_ID FROM CUSTOMER WHERE C_USERNAME = '$username'";
    $arr = oci_parse($conn, $query);
    oci_execute($arr);
    $cid = oci_fetch_array($arr)[0];
    $sql = "DELETE FROM ORDERS WHERE PRODUCT_ID = '$pid' AND C_ID = '$cid'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);


}




?>