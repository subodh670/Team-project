<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    include("../connectionPHP/connect.php");
    $proid = $_GET['proId'];
    $username = $_GET['username'];
    $query = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
    $arr = oci_parse($conn, $query);
    oci_execute($arr);
    $custId = oci_fetch_array($arr)[0];
    // echo $proid;
    $sql = "SELECT NAME FROM PRODUCT WHERE PRODUCT_ID = '$proid'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $pName = oci_fetch_array($arr)[0];
    $sql = "SELECT WISHLIST_ID FROM WISHLIST WHERE ITEMS = '$pName' AND FK_USER_ID = $custId";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $react = oci_fetch_array($arr);
    if(!isset($react[0])){
        echo json_encode([0]);
    }
    else{
        echo json_encode([1]);
    }
}

?>