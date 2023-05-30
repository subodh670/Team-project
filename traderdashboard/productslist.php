<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    include("../connectionPHP/connect.php");
    $trader = $_GET['trader'];
    $sql = "SELECT PRODUCT.NAME, PRODUCT.PRODUCT_ID FROM PRODUCT,SHOP,MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND  MART_USER.USER_ID = $trader";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $result = array();
    while($row = oci_fetch_array($arr)){
        $result[] = $row;
        // var_dump($row);
    }
    echo json_encode($result);
}



?>