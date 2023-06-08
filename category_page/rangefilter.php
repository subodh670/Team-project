<?php


// echo $rows;
if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $min = $_GET['min'];
    $max = $_GET['max'];
    $cat = $_GET['catname'];

    if(isset($min) && isset($max)){
        if(is_string($min) && is_string($max) && intval((int)$max) && intval((int)$min) && intval((int)$max) > intval((int)$min)){
            // echo "hello";
            $min = (int)$min;
            $max = (int)$max;
            $sql = "SELECT PRODUCT_ID, PRODUCT.NAME, PRODUCT.DESCRIPTION, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE1, PRODUCT.IMAGE2, PRODUCT.IMAGE3, CATEGORY.CATEGORY_NAME FROM PRODUCT,CATEGORY WHERE PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND CATEGORY.CATEGORY_NAME = '$cat' AND PRODUCT.PRICE BETWEEN '$min' AND '$max'";
            $arr = oci_parse($conn, $sql);
            oci_execute($arr);
            $rows = oci_fetch_all($arr, $a);
            echo json_encode($a);
        }
        else{
            echo json_encode([0]);
        }
    }
    else{
        echo json_encode([0]);
    }
}

?>