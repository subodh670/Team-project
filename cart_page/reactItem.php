<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    include("../connectionPHP/connect.php");
    $dataLove = $_GET['wish'];
    $prodId = $_GET['proId'];
    $custname = $_GET['custname'];
    $query = "SELECT C_ID FROM CUSTOMER WHERE C_USERNAME = '$custname'";
    $arr = oci_parse($conn, $query);
    oci_execute($arr);
    $custId = oci_fetch_array($arr)[0];
    if($dataLove=='1'){
        $sql = "INSERT INTO WISHLIST(PRODUCT_ID, C_ID) VALUES ('$prodId', '$custId')";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        oci_close($conn);
    }
    else{
        $sql = "DELETE FROM WISHLIST WHERE PRODUCT_ID = '$prodId' AND C_ID = '$custId'";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        oci_close($conn);
    }
}
?>