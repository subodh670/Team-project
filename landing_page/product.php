<?php


// echo $rows;
if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $sql = "SELECT PRODUCT_ID, PRODUCT.NAME, PRODUCT.DESCRIPTION, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE1, PRODUCT.IMAGE2, PRODUCT.IMAGE3, CATEGORY.CATEGORY_NAME FROM PRODUCT,CATEGORY WHERE PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND PRODUCT.STATUS = 1";
    $array = oci_parse($conn, $sql);
    oci_execute($array);
    $rows = oci_fetch_all($array, $a);
    echo json_encode($a);
}

?>