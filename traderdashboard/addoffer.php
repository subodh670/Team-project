<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    include("../connectionPHP/connect.php");
    $productid = $_GET['offerPro'];
    $date = $_GET['date'];
    $offer = $_GET['offer'];
    $trader = $_GET['traderid'];
    $offername = $_GET['offername'];
    echo $date;
    echo $offer;
    echo $productid;
    echo $trader;
    $query = "SELECT OFFER_ID FROM OFFER_PRODUCT, PRODUCT WHERE OFFER_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID AND PRODUCT_ID = $productid";
    $lt = oci_parse($conn, $query);
    oci_execute($lt);
    $result = oci_fetch_array($lt)[0];
    echo $result;   
    if(isset($result)){
        $sql = "SELECT OFFER_ID FROM OFFER_PRODUCT WHERE PRODUCT_ID = '$productid'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr); 
        $offer_id = oci_fetch_array($arr)[0];
        $sql = "UPDATE OFFER SET OFFER_NAME = '$offername' , OFFER_PERCENTAGE = '$offer' , OFFER_VALID_DATE = '$date' WHERE OFFER_ID = '$offer_id'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr); 
    }   
    else{
        $sql = "INSERT INTO OFFER_PRODUCT(PRODUCT_ID) VALUES('$productid')";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $sql = "INSERT INTO OFFER(OFFER_NAME,OFFER_PERCENTAGE, OFFER_VALID_DATE, FK_USER_ID) VALUES ('$offername', $offer, '$date', '$trader')";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        // $sql = "SELECT OFFER_ID FROM OFFER_PRODUCT WHERE PRODUCT_ID = '$productid'";
        // $arr = oci_parse($conn, $sql);
        // oci_execute($arr);
    }


}









?>