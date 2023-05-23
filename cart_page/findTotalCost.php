<?php


if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $username = $_GET['name'];
    $query = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
    $arr = oci_parse($conn, $query);
    oci_execute($arr);
    $userid = oci_fetch_array($arr)[0];
    $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$userid'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $cartId = oci_fetch_array($arr)[0];
    // $sql = "SELECT PRODUCT_PRICE, ORDERS.PRODUCT_QUANTITY FROM ORDERS, PRODUCT WHERE ORDERS.PRODUCT_ID = PRODUCT.PRODUCT_ID AND ORDERS.C_ID ='$cid'";
    // $sql = "SELECT TOTAL_COST, PRODUCT_ORDER.QUANTITY FROM PRODUCT_ORDER, CART WHERE PRODUCT_ORDER.FK_CART_ID = CART.CART_ID AND CART.FK_USER_ID ='$userid'";    
    $sql = "SELECT ORDERED_PRODUCT.ORDER_ID, ORDERED_PRODUCT.TOTAL_COST FROM ORDERED_PRODUCT INNER JOIN PRODUCT_ORDER ON ORDERED_PRODUCT.ORDER_ID=PRODUCT_ORDER.ORDER_ID AND FK_CART_ID = $cartId";
    
    $array = oci_parse($conn, $sql);
    oci_execute($array);
    $price = array();
    
    while($rows = oci_fetch_array($array)){
        $price[] = $rows[1];
    }
    if(isset($price)){
        echo json_encode($price);
    }
}







?>