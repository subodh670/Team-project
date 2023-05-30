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
    $sql = "SELECT PRICE FROM PRODUCT WHERE PRODUCT_ID = '$pid'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $price = oci_fetch_array($arr)[0];
    // $sql = "SELECT NAME , PRICE FROM PRODUCT  WHERE PRODUCT_ID = '$pid'";
    // $array = oci_parse($conn, $sql);
    // oci_execute($array);
    // $pname = oci_fetch_array($array);
    // // echo $quant;
    // $price = $pname[1];
    $sql = "SELECT CART_ID FROM CART WHERE  CART.FK_USER_ID = '$c_id'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $cart_id = oci_fetch_array($arr)[0];
    // $sql ="SELECT ORDERED_PRODUCT.ORDER_ID FROM ORDERED_PRODUCT INNER JOIN PRODUCT_ORDER ON ORDERED_PRODUCT.ORDER_ID = PRODUCT_ORDER.ORDER_ID AND PRODUCT_ORDER.FK_CART_ID = '$cart_id'";
    // $arr = oci_parse($conn, $sql);
    // oci_execute($arr);
    // $order_id = oci_fetch_array($arr)[0];
    // $slotArr = oci_parse($conn, "SELECT ORDERED_PRODUCT.QUANTITY FROM PRODUCT_ORDER INNER JOIN ORDERED_PRODUCT ON PRODUCT_ORDER.ORDER_ID = ORDERED_PRODUCT.ORDER_ID AND PRODUCT_ORDER.FK_CART_ID = '$cart_id'");
    // oci_execute($slotArr);
    // $slotQ = 0;
    // while($rows = oci_fetch_array($slotArr)){
    //     $slotQ += $rows[0];
    // }
    $sql = "SELECT TOTAL_ITEMS FROM PRODUCT_CART WHERE CART_ID = '$cart_id'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $sum = 0;
    while($row = oci_fetch_array($arr)){
        $sum += $row[0];
    }
    $canAdd = $quant <= 20 && $quant>0 ? true:false;
    // echo $slotQ;
    // echo "<br>";
    // echo $canAdd;
    // echo $cart_id;
    if($canAdd == true){
        // echo $quant;
        // $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$c_id'";
        // $arr = oci_parse($conn, $sql);
        // oci_execute($arr);
        // $cartId = oci_fetch_array($arr)[0];
        if($quant<0){
            $quant = 0;
        }
        // echo $quant;
        $query1 = "UPDATE PRODUCT_CART SET TOTAL_ITEMS = $quant WHERE CART_ID = '$cart_id' AND PRODUCT_ID = '$pid' ";
        $array2 = oci_parse($conn, $query1);
        oci_execute($array2);
        echo json_encode([true]);
    }
    else{
        echo json_encode([false]);
    }
}
?>