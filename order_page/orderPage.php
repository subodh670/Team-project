<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $username = $_GET['name'];
    // echo $username;
    $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $c_id = oci_fetch_array($arr)[0];
    $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$c_id'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $cartId = oci_fetch_array($arr)[0];
    // echo $c_id;
    $query = "SELECT PRODUCT_CART.TOTAL_ITEMS, PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.IMAGE2, PRODUCT.STOCK_AVAILABLE, PRODUCT_CART.CART_ID FROM PRODUCT_CART, PRODUCT WHERE PRODUCT_CART.PRODUCT_ID = PRODUCT.PRODUCT_ID AND PRODUCT_CART.CART_ID = $cartId";

    // $query = "SELECT ORDERS.PRODUCT_QUANTITY, PRODUCT.PRODUCT_PRICE FROM ORDERS, PRODUCT WHERE PRODUCT.PRODUCT_ID = ORDERS.PRODUCT_ID AND C_ID = '$c_id'";
    // $query = "SELECT PRODUCT_ORDER.QUANTITY, PRODUCT.NAME, PRODUCT.PRICE FROM PRODUCT_ORDER,PRODUCT,CATEGORY,CART WHERE PRODUCT_ORDER.FK_CART_ID = CART.CART_ID AND PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND PRODUCT.NAME = CART.ITEMS AND CART.FK_USER_ID = '$c_id'";
    // $query = "SELECT ORDERED_PRODUCT.ORDER_ID, ORDERED_PRODUCT.TOTAL_COST, ORDERED_PRODUCT.QUANTITY FROM ORDERED_PRODUCT INNER JOIN PRODUCT_ORDER ON ORDERED_PRODUCT.ORDER_ID=PRODUCT_ORDER.ORDER_ID AND FK_CART_ID = $cartId";
    $arr2 = oci_parse($conn, $query);
    oci_execute($arr2);
    $sum = 0;
    $totalQuant = 0;
    while($rows = oci_fetch_array($arr2)){
        $sum += $rows[0]*$rows[2];
        $totalQuant += $rows[0];
    }
    // echo $sum;
    echo json_encode([$sum , $totalQuant]);


}



?>