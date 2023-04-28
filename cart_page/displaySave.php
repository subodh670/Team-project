<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    session_start();
    include("../connectionPHP/connect.php");
    $username = $_SESSION['username'];
    $sql = "SELECT C_ID FROM CUSTOMER WHERE C_USERNAME = '$username'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $c_id = oci_fetch_array($arr)[0];
    $query = "SELECT PRODUCT_NAME, PRODUCT.PRODUCT_PRICE, PRODUCT.SHOP_ID, SHOP.SHOP_NAME,PRODUCT.PRODUCT_QUANTITY, PRODUCT.PRODUCT_CATEGORY, PRODUCT.PRODUCT_IMAGE2, PRODUCT.PRODUCT_ID, SUM(P_QUANTITY) FROM PRODUCT, CART, SHOP WHERE CART.PRODUCT_ID = PRODUCT.PRODUCT_ID AND PRODUCT.SHOP_ID = SHOP.SHOP_ID AND C_ID = $c_id GROUP BY PRODUCT.PRODUCT_ID, PRODUCT.PRODUCT_NAME, PRODUCT.PRODUCT_PRICE, PRODUCT.PRODUCT_QUANTITY, PRODUCT.PRODUCT_CATEGORY, PRODUCT.PRODUCT_IMAGE2, PRODUCT.SHOP_ID, SHOP.SHOP_NAME, PRODUCT.PRODUCT_ID";
    $arr = oci_parse($conn, $query);
    oci_execute($arr);
    $items = array();
    while($rows = oci_fetch_array($arr)){
        $items[] = $rows;
    }
    echo json_encode($items);
}



?>