<?php
 if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $cname = $_GET['cname'];
    $query = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$cname'";
    $arr1 = oci_parse($conn, $query);
    oci_execute($arr1);
    $custId = oci_fetch_array($arr1)[0];
    // $sql = "SELECT PRODUCT_NAME FROM ORDERS, PRODUCT WHERE ORDERS.PRODUCT_ID = PRODUCT.PRODUCT_ID AND C_ID = $custId";
    $sql = "SELECT CART.ITEMS FROM PRODUCT_ORDER, CART WHERE PRODUCT_ORDER.FK_CART_ID = CART.CART_ID AND CART.FK_USER_ID = $custId";

    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $pro = array();
    while($row = oci_fetch_array($arr)){
        $pro[] = $row[0];
    }
    echo json_encode($pro);






 }





?>