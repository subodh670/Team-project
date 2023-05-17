<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    include("../connectionPHP/connect.php");
    $productid = $_GET['offerPro'];
    $date = $_GET['date'];
    $offer = $_GET['offer'];
    $trader = $_GET['traderid'];
    $offername = $_GET['offername'];
    echo $productid;
    echo $offer;
    echo $productid;
    echo $trader;
    $sql = "SELECT NAME FROM PRODUCT WHERE PRODUCT_ID = '$productid'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $pname = oci_fetch_array($arr)[0];
    $query = "SELECT OFFER_PRODUCT.OFFER_ID FROM OFFER_PRODUCT, PRODUCT WHERE OFFER_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID AND PRODUCT.PRODUCT_ID = $productid";
    $lt = oci_parse($conn, $query);
    oci_execute($lt);
    $result = oci_fetch_array($lt);
    // echo $result;   
    if(isset($result[0])){
        $offer_id = $result[0];
        $sql = "SELECT OFFER_ID FROM OFFER_PRODUCT WHERE PRODUCT_ID = '$productid'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr); 
        $offer_id = oci_fetch_array($arr)[0];
        $sql = "UPDATE OFFER SET OFFER_NAME = '$offername' , OFFER_PERCENTAGE = '$offer' , OFFER_VALID_DATE = '$date' WHERE OFFER_ID = '$offer_id'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr); 
    }   
    else{
        $sql = "INSERT INTO OFFER(OFFER_NAME,OFFER_PERCENTAGE, OFFER_VALID_DATE, FK_USER_ID, ITEMS) VALUES ('$offername', '$offer', '$date', '$trader','$pname')";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $sql = "SELECT OFFER_ID FROM OFFER WHERE ITEMS = '$pname' AND FK_USER_ID = '$trader'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $offer_id = oci_fetch_array($arr)[0];
        $sql = "INSERT INTO OFFER_PRODUCT(OFFER_ID , PRODUCT_ID) VALUES('$offer_id','$productid')";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        
        
    }


}









?>