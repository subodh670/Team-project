<?php
 if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $cname = $_GET['cname'];
    $query = "SELECT C_ID FROM CUSTOMER WHERE C_USERNAME = '$cname'";
    $arr1 = oci_parse($conn, $query);
    oci_execute($arr1);
    $custId = oci_fetch_array($arr1)[0];
    $sql = "SELECT PRODUCT_NAME FROM ORDERS, PRODUCT WHERE ORDERS.PRODUCT_ID = PRODUCT.PRODUCT_ID AND C_ID = $custId";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $pro = array();
    while($row = oci_fetch_array($arr)){
        $pro[] = $row[0];
    }
    echo json_encode($pro);






 }





?>