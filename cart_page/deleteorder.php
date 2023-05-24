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
    $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$cid'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $cart_id = oci_fetch_array($arr)[0];
    $sql = "SELECT ORDER_ID FROM PRODUCT_ORDER WHERE FK_CART_ID = '$cart_id'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $order_id = oci_fetch_array($arr);
    // $sql = "DELETE FROM PRODUCT_ORDER WHERE ORDER_ID = '$order_id'";
    // $arr = oci_parse($conn, $sql);
    // oci_execute($arr);
    // echo "NEE";
    $sql = "SELECT COLLECTION_SLOT.SLOT_ID, COLLECTION_SLOT.STATUS FROM COLLECTION_SLOT, PRODUCT_ORDER WHERE COLLECTION_SLOT.SLOT_ID = PRODUCT_ORDER.FK_SLOT_ID AND PRODUCT_ORDER.FK_CART_ID = '$cart_id' AND COLLECTION_SLOT.STATUS = 1";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $slotidarr = oci_fetch_array($arr);
    $slotid = $slotidarr[0];
    $slotstatus = $slotidarr[1];
    if(isset($order_id[0]) && $slotstatus == 1){
        $order = $order_id[0];
        $sql = "DELETE FROM ORDERED_PRODUCT WHERE ORDER_ID = '$order' AND PRODUCT_ID = '$pid'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $sql = "SELECT ORDER_ID FROM ORDERED_PRODUCT WHERE ORDER_ID = '$order'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $count = 0;
        while($rows = oci_fetch_array($arr)){
            $count++;
        }
        if($count == 0 && $slotstatus == 1){
           
            $sql = "DELETE FROM PRODUCT_ORDER WHERE ORDER_ID = '$order'";
            $arr = oci_parse($conn, $sql);
            oci_execute($arr);
            $sql = "DELETE FROM COLLECTION_SLOT WHERE SLOT_ID = '$slotid'";
            $arr = oci_parse($conn, $sql);
            oci_execute($arr);
            // echo "HOGAYA";
            echo json_encode([true]);
        }
    }
    
}




?>