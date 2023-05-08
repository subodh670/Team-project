<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    include("../connectionPHP/connect.php");
    $productid = $_GET['offerPro'];
    $date = $_GET['date'];
    $offer = $_GET['offer'];
    $trader = $_GET['traderid'];
    echo $date;
    echo $offer;
    echo $productid;
    echo $trader;
    $query = "SELECT OFFER_ID FROM OFFER WHERE PRODUCT_ID = $productid AND TRADER_ID = $trader";
    $lt = oci_parse($conn, $query);
    oci_execute($lt);
    $result = oci_fetch_array($lt)[0];
    echo $result;   
    if(isset($result)){
        $sql = "UPDATE OFFER SET OFFER_PER = '$offer' , OFFER_VALID = '$date' WHERE TRADER_ID = '$trader' AND PRODUCT_ID = '$productid'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr); 
    }   
    else{
        $sql = "INSERT INTO OFFER(PRODUCT_ID, TRADER_ID, OFFER_PER, OFFER_VALID) VALUES ('$productid', $trader, '$offer', '$date')";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
    }


}









?>