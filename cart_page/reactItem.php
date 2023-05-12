<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    include("../connectionPHP/connect.php");
    $dataLove = $_GET['wish'];
    $prodId = $_GET['proId'];
    $custname = $_GET['custname'];
    $query = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$custname'";
    $arr = oci_parse($conn, $query);
    oci_execute($arr);
    $custId = oci_fetch_array($arr)[0];
    $sql = "SELECT NAME FROM PRODUCT WHERE PRODUCT_ID = '$prodId'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $pName = oci_fetch_array($arr)[0];
    echo $pName;
    if($dataLove=='1'){
        $sql = "INSERT INTO WISHLIST(ITEMS, FK_USER_ID) VALUES ('$pName', '$custId')";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        $sql = "SELECT WISHLIST_ID FROM WISHLIST WHERE ITEMS='$pName' AND FK_USER_ID = '$custId'";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        $wish_id = oci_fetch_array($array)[0];
        $sql = "INSERT INTO WISHLIST_PRODUCT(WISHLIST_ID, PRODUCT_ID) VALUES('$wish_id', '$prodId')";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
    }
    else{
        $sql = "DELETE FROM WISHLIST WHERE ITEMS = '$pName' AND FK_USER_ID = '$custId'";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        $sql = "SELECT WISHLIST_ID FROM WISHLIST WHERE ITEMS='$pName' AND FK_USER_ID = '$custId'";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        $wish_id = oci_fetch_array($array)[0];
        $sql = "DELETE FROM WISHLIST_PRODUCT WHERE WISHLIST_ID ='$wish_id' AND PRODUCT_ID = '$prodId'";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
    }
}
?>