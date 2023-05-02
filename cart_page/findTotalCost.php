<?php


if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $username = $_GET['name'];
    $query = "SELECT C_ID FROM CUSTOMER WHERE C_USERNAME = '$username'";
    $arr = oci_parse($conn, $query);
    oci_execute($arr);
    $cid = oci_fetch_array($arr)[0];
    $sql = "SELECT PRODUCT_PRICE, ORDERS.PRODUCT_QUANTITY FROM ORDERS, PRODUCT WHERE ORDERS.PRODUCT_ID = PRODUCT.PRODUCT_ID AND ORDERS.C_ID ='$cid'";
    $array = oci_parse($conn, $sql);
    oci_execute($array);
    $price = array();
    
    while($rows = oci_fetch_array($array)){
        $price[] = $rows[0]*$rows[1];
    }
    if(isset($price)){
        echo json_encode($price);
    }
}







?>