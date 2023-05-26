<?php


// echo $rows;
if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $value = $_GET['value'];
    $dateFrom = $_GET['datefrom'];
    $dateto = $_GET['dateto'];
    $sql = "SELECT PRODUCT_ID, PRODUCT.NAME, PRODUCT.DESCRIPTION, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE1, PRODUCT.IMAGE2, PRODUCT.IMAGE3, CATEGORY.CATEGORY_NAME FROM PRODUCT,CATEGORY, SHOP WHERE PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND SHOP.NAME = '$value' ";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $rows = oci_fetch_all($arr, $a);
    echo json_encode($a);
}

?>