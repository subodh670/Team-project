<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    include("../connectionPHP/connect.php");
    // $sql = "SELECT COLLECTION_DATE FROM COLLECTION_SLOT WHERE STATUS= 1";
    session_start();
    $username = $_SESSION['username'];
    $query = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
    $arr = oci_parse($conn, $query);
    oci_execute($arr);
    $cid = oci_fetch_array($arr)[0];
    $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$cid'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $cartId = oci_fetch_array($arr)[0];
    $sql = "SELECT SLOT_ID,COLLECTION_SLOT.COLLECTION_DATE FROM COLLECTION_SLOT, PRODUCT_ORDER WHERE COLLECTION_SLOT.SLOT_ID = PRODUCT_ORDER.FK_SLOT_ID AND PRODUCT_ORDER.FK_CART_ID = '$cartId' AND COLLECTION_SLOT.STATUS = 1";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $date = oci_fetch_array($arr);
    if(isset($date[0])){
        $date1 = $date[0];
        echo json_encode([$date1, $date[1]]);
    }
    else{
        echo json_encode([""]);
    }
}
?>