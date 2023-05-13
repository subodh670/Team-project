<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    session_start();
    $id = $_GET['id'];
    $name = $_GET['name'];
    // $cid = $_GET['cid'];
   
    $username = $_SESSION['username'];
    $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
    $array = oci_parse($conn, $sql);
    oci_execute($array);
    $cid = oci_fetch_array($array)[0];
    // $sql = "SELECT TOTAL_ITEMS FROM CART WHERE ITEMS = '$name' AND FK_USER_ID = '$cid'";
    // $array = oci_parse($conn, $sql);
    // oci_execute($array);   
    // $totalitem = $sql
    $sql = "INSERT INTO CART(TOTAL_ITEMS, ITEMS, FK_USER_ID) VALUES(1, '$name', '$cid')";
    $array = oci_parse($conn, $sql);
    oci_execute($array);    
    $sql = "SELECT CART_ID FROM CART WHERE ITEMS = '$name' AND FK_USER_ID = '$cid'";
    $array = oci_parse($conn, $sql);
    oci_execute($array);
    $cart_id = oci_fetch_array($array)[0];
    $sql = "SELECT PRODUCT_ID FROM PRODUCT WHERE NAME = '$name'";
    $array = oci_parse($conn, $sql);
    oci_execute($array);
    $pid = oci_fetch_array($array)[0];
    $sql = "INSERT INTO PRODUCT_CART(PRODUCT_ID, CART_ID) VALUES($pid, $cart_id)";
    $array = oci_parse($conn, $sql);
    oci_execute($array);












}

?>