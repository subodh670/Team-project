<?php


// echo $rows;
if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $search = $_GET['search'];
    // echo $search;
    $cat = $_GET['catname'];
    $sql = "SELECT PRODUCT_ID, PRODUCT.NAME, PRODUCT.DESCRIPTION, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE1, PRODUCT.IMAGE2, PRODUCT.IMAGE3, CATEGORY.CATEGORY_NAME FROM PRODUCT,CATEGORY WHERE PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND CATEGORY.CATEGORY_NAME = '$cat' AND PRODUCT.NAME LIKE '%$search%'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $rows = oci_fetch_all($arr, $a);
    echo json_encode($a);
}

?>