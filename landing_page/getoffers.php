<?php


// echo $rows;
if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $sql = "SELECT PRODUCT.PRODUCT_ID, OFFER_PRODUCT.OFFER_ID FROM PRODUCT, OFFER_PRODUCT WHERE PRODUCT.PRODUCT_ID = OFFER_PRODUCT.PRODUCT_ID";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $array = array();
    while($row = oci_fetch_array($arr)){
        $offer_id = $row[1];
        $sql2 = "SELECT OFFER_PERCENTAGE FROM OFFER WHERE OFFER_ID = $offer_id";
        $arr2 = oci_parse($conn, $sql2);
        oci_execute($arr2);
        $offerP = oci_fetch_array($arr2)[0];
        array_push($array, [$row[0], $offerP]);
    }
    echo json_encode($array);
}

?>