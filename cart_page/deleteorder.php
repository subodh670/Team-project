<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $pid = $_GET['pid'];
    $pname = $_GET['pname'];
    $quantity = $_GET['quant'];
    $slot = $_GET['slot'];
    $username = $_GET['username'];
    $query = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
    $arr = oci_parse($conn, $query);
    oci_execute($arr);
    $cid = oci_fetch_array($arr)[0];
    $sql = "SELECT CART_ID FROM CART WHERE ITEMS = '$pname' AND FK_USER_ID = '$cid'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $cart_id = oci_fetch_array($arr)[0];
    $sql = "SELECT ORDER_ID FROM PRODUCT_ORDER WHERE FK_CART_ID = '$cart_id'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $order_id = oci_fetch_array($arr)[0];
    $sql = "DELETE FROM PRODUCT_ORDER WHERE ORDER_ID = '$order_id'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $sql = "DELETE FROM ORDERED_PRODUCT WHERE ORDER_ID = '$order_id' AND PRODUCT_ID = '$pid'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
}




?>