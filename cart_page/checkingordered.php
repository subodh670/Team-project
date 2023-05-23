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
    $sql = "SELECT CART_ID FROM CART WHERE CART.FK_USER_ID = '$c_id'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $cart_id = oci_fetch_array($arr)[0];
    // echo $cart_id;
    $query = "SELECT PRODUCT_ORDER.ORDER_ID FROM PRODUCT_ORDER INNER JOIN ORDERED_PRODUCT ON PRODUCT_ORDER.ORDER_ID = ORDERED_PRODUCT.ORDER_ID AND PRODUCT_ORDER.FK_CART_ID = '$cart_id'";
    $array = oci_parse($conn, $query);
    oci_execute($array);
    $row = oci_fetch_array($array);
    if(isset($row[0])){
        echo json_encode([true]);
    }
    else{
        echo json_encode([false]);
    }
}
?>