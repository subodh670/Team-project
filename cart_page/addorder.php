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
    $sqlExist = "SELECT ORDER_ID FROM ORDERS WHERE PRODUCT_ID = '$pid' AND C_ID = '$cid'";
    $arr2 = oci_parse($conn, $sqlExist);
    oci_execute($arr2); 
    // echo $orderid;?
    $arr = oci_fetch_array($arr2);
    $slotArr = oci_parse($conn, "SELECT PRODUCT_QUANTITY FROM ORDERS WHERE C_ID = $cid");
    oci_execute($slotArr);
    $slotQ = 0;
    while($rows = oci_fetch_array($slotArr)){
        $slotQ += $rows[0];
    }
    $canAdd = $slotQ<=20 ? true:false;
    if(isset($arr[0]) && $canAdd == true){
        $orderid = $arr[0];
        // echo $orderid;
        $sql3 = "UPDATE ORDERS SET PRODUCT_QUANTITY = '$quantity' WHERE ORDER_ID = '$orderid'";
        $arr3 = oci_parse($conn, $sql3);
        oci_execute($arr3);
    }
    else if($canAdd == true){
        // echo "eeeee";
        $sqlforTraderid = "SELECT TRADER_ID FROM PRODUCT WHERE PRODUCT_ID = '$pid'";
        $arr4 = oci_parse($conn, $sqlforTraderid);
        oci_execute($arr4);
        $traderid = oci_fetch_array($arr4)[0];
        $sql4 = "INSERT INTO ORDERS(PRODUCT_QUANTITY, PRODUCT_ID, C_ID, TRADER_ID, ORDER_TIME, ORDER_DAY) VALUES ('$quantity', '$pid', '$cid', '$traderid','$slot', 'wed')";
        $arr5 = oci_parse($conn, $sql4);
        oci_execute($arr5);
    }

    else{
        json_encode(['cannot be more than 20']);
    }




}




?>