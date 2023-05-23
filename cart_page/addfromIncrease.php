<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    session_start();
    include("../connectionPHP/connect.php");
    $username = $_GET['name'];
    // echo $username;
    $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $c_id = oci_fetch_array($arr)[0];
    $pid = $_GET['pid'];
    $quant = $_GET['quant'];
    $sql = "SELECT NAME , PRICE FROM PRODUCT     WHERE PRODUCT_ID = '$pid'";
    $array = oci_parse($conn, $sql);
    oci_execute($array);
    $pname = oci_fetch_array($array);
    // echo $quant;
    $price = $pname[1];
    $sql = "SELECT CART_ID FROM CART WHERE  CART.FK_USER_ID = '$c_id'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $cart_id = oci_fetch_array($arr)[0];
    $slotArr = oci_parse($conn, "SELECT ORDERED_PRODUCT.QUANTITY FROM PRODUCT_ORDER INNER JOIN ORDERED_PRODUCT ON PRODUCT_ORDER.ORDER_ID = ORDERED_PRODUCT.ORDER_ID AND PRODUCT_ORDER.FK_CART_ID = '$cart_id'");
    oci_execute($slotArr);
    $slotQ = 0;
    while($rows = oci_fetch_array($slotArr)){
        $slotQ += $rows[0];
    }
    $canAdd = $slotQ <= 20 ? true:false;
    // echo $slotQ;
    // echo "<br>";
    // echo $canAdd;
    // echo $cart_id;
    if($canAdd == true){
        $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$c_id'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $cartId = oci_fetch_array($arr)[0];
        $sqlExist = "SELECT ORDER_ID FROM PRODUCT_ORDER WHERE FK_CART_ID = '$cartId'";
        $arr2 = oci_parse($conn, $sqlExist);
        oci_execute($arr2); 
        // echo $orderid;?
        $order_id = oci_fetch_array($arr2);
        $total = $price * $quant;
        $query = "UPDATE ORDERED_PRODUCT SET QUANTITY = $quant, TOTAL_COST = '$total' WHERE ORDER_ID = '$cartId'";
        $array = oci_parse($conn, $query);
        oci_execute($array);
        // $sql = "SELECT ORDER_ID FROM PRODUCT_ORDER WHERE FK_CART_ID = '$cart_id'";
        // $array = oci_parse($conn, $query);
        // oci_execute($array);
        // $order_id = oci_fetch_array($array)[0];
        $name = $pname[0];
        $query1 = "UPDATE PRODUCT_CART SET TOTAL_ITEMS = $quant WHERE CART_ID = '$cartId' AND PRODUCT_ID = '$pid' ";
        $array2 = oci_parse($conn, $query1);
        oci_execute($array2);
        echo json_encode([true]);
    }
    else{
        echo json_encode([false]);
    }
}
?>