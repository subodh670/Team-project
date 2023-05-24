<?php
 if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $cname = $_GET['cname'];
    $query = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$cname'";
    $arr1 = oci_parse($conn, $query);
    oci_execute($arr1);
    $custId = oci_fetch_array($arr1)[0];
    $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$custId'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $cartId = oci_fetch_array($arr)[0];
    // $sql = "SELECT PRODUCT_NAME FROM ORDERS, PRODUCT WHERE ORDERS.PRODUCT_ID = PRODUCT.PRODUCT_ID AND C_ID = $custId";
    // $sql = "SELECT CART.ITEMS FROM PRODUCT_ORDER, CART WHERE PRODUCT_ORDER.FK_CART_ID = CART.CART_ID AND CART.FK_USER_ID = $custId";
    $sql = "SELECT ORDERED_PRODUCT.ORDER_ID, ORDERED_PRODUCT.PRODUCT_ID, ORDERED_PRODUCT.QUANTITY FROM ORDERED_PRODUCT INNER JOIN PRODUCT_ORDER ON ORDERED_PRODUCT.ORDER_ID=PRODUCT_ORDER.ORDER_ID AND FK_CART_ID = $cartId";

    $arr1 = oci_parse($conn, $sql);
    oci_execute($arr1);
    $pro = array();
    // $count = 0;
    while($row = oci_fetch_array($arr1)){
        $pro1 = $row[1];
        $sql = "SELECT NAME FROM PRODUCT WHERE PRODUCT_ID = '$pro1'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $pro[] = oci_fetch_array($arr)[0];
        array_push($pro, $row[2]);

    }
    echo json_encode($pro);






 }





?>