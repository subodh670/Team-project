<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $pid = $_GET['pid'];
    $quantity = $_GET['quant'];
    $slot = $_GET['slot'];
    $day = $_GET['day'];
    $price = $_GET['price'];
    $pName = $_GET['pname'];
    $username = $_GET['username'];
    $query = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
    $arr = oci_parse($conn, $query);
    oci_execute($arr);
    $cid = oci_fetch_array($arr)[0];
    // $sqlExist = "SELECT ORDER_ID FROM ORDERS WHERE PRODUCT_ID = '$pid' AND C_ID = '$cid'";
    // $sql = "SELECT NAME FROM PRODUCT WHERE PRODUCT_ID = '$pid'";
    // $arr = oci_parse($conn, $sql);
    // oci_execute($sql);
    // $pName = oci_fetch_array($arr)[0];
    $sql = "SELECT CART_ID FROM CART WHERE ITEMS = '$pName' AND FK_USER_ID = $cid";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $cartId = oci_fetch_array($arr)[0];
    $sqlExist = "SELECT ORDERED_PRODUCT.ORDER_ID
    FROM ORDERED_PRODUCT
    INNER JOIN PRODUCT_ORDER ON ORDERED_PRODUCT.ORDER_ID = PRODUCT_ORDER.ORDER_ID AND ORDERED_PRODUCT.PRODUCT_ID = '$pid' AND PRODUCT_ORDER.FK_CART_ID= '$cartId' ";
    $arr2 = oci_parse($conn, $sqlExist);
    oci_execute($arr2); 
    // echo $orderid;?
    $arr = oci_fetch_array($arr2);
    $slotArr = oci_parse($conn, "SELECT SLOT_ID, PRODUCT_ORDER.QUANTITY FROM COLLECTION_SLOT, PRODUCT_ORDER WHERE COLLECTION_SLOT.SLOT_ID = PRODUCT_ORDER.FK_SLOT_ID AND COLLECTION_DATE = '$slot' AND  DAY = '$day' AND COLLECTION_SLOT.STATUS = '1'");
    oci_execute($slotArr);
    $slotQ = 0;
    while($rows = oci_fetch_array($slotArr)){
        $slotQ += $rows[1];
    }
    $canAdd = $slotQ<=20 ? true:false;
    if(isset($arr[0]) && $canAdd == true){
        $orderid = $arr[0];
        // echo $orderid;
        $sql3 = "UPDATE PRODUCT_ORDER SET QUANTITY = '$quantity' WHERE ORDER_ID = '$orderid'";
        $arr3 = oci_parse($conn, $sql3);
        oci_execute($arr3);
    }
    else if($canAdd == true){
        // echo "eeeee";
        // $sqlforTraderid = "SELECT TRADER_ID FROM PRODUCT WHERE PRODUCT_ID = '$pid'";
        // $arr4 = oci_parse($conn, $sqlforTraderid);
        // oci_execute($arr4);
        // $traderid = oci_fetch_array($arr4)[0];
        // $sql4 = "INSERT INTO ORDERS(PRODUCT_QUANTITY, PRODUCT_ID, C_ID, TRADER_ID, ORDER_TIME, ORDER_DAY) VALUES ('$quantity', '$pid', '$cid', '$traderid','$slot', 'wed')";


        $total_cost = $price*$quantity;
        $sql4 = "INSERT INTO PRODUCT_ORDER(QUANTITY, FK_CART_ID, STATUS, TOTAL_COST) VALUES($quantity, $cartId, 1,$total_cost )"; 
        $arr5 = oci_parse($conn, $sql4);
        oci_execute($arr5);
        $sql = "SELECT CART_ID, ORDER_ID FROM CART,PRODUCT_ORDER WHERE CART.CART_ID = PRODUCT_ORDER.FK_CART_ID AND ITEMS = '$pName' AND FK_USER_ID = '$cid'";
        $arr5 = oci_parse($conn, $sql);
        oci_execute($arr5);
        $order_id= oci_fetch_array($arr5)[1];
        $sql = "INSERT INTO ORDERED_PRODUCT(ORDER_ID, PRODUCT_ID) VALUES('$order_id', '$pid')";
        $arr5 = oci_parse($conn, $sql);
        oci_execute($arr5);
    }

    else{
        json_encode(['cannot be more than 20']);
    }




}




?>