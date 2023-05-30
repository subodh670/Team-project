<?php

// if($_SERVER['REQUEST_METHOD'] == "POST"){
//     include("../connectionPHP/connect.php");
//     $productid = $_GET['offerPro'];
//     $date = $_GET['date'];
//     $offer = $_GET['offer'];
//     $trader = $_GET['traderid'];
//     $offername = $_GET['offername'];
//     $offer_id = $_GET['offerid'];
//     echo $productid;
//     echo $offer;
//     echo $productid;
//     echo $trader;
//     $sql = "SELECT NAME FROM PRODUCT WHERE PRODUCT_ID = $productid  ";
//     $arr = oci_parse($conn, $sql);
//     oci_execute($arr);
//     $pname = oci_fetch_array($arr)[0];
//     $query = "UPDATE OFFER_PRODUCT SET PRODUCT_ID = '$productid' WHERE OFFER_ID = '$offer_id'";
//     $arr = oci_parse($conn, $sql);
//     oci_execute($arr);
//     $query = "UPDATE OFFER SET OFFER_NAME = '$offername', OFFER_PERCENTAGE = '$offer', OFFER_VALID_DATE = '$date' WHERE  OFFER_ID = '$offer_id'";
//     $arr = oci_parse($conn, $sql);
//     oci_execute($arr);
//     // $query = "SELECT OFFER_PRODUCT.OFFER_ID FROM OFFER_PRODUCT, PRODUCT WHERE OFFER_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID AND PRODUCT.PRODUCT_ID = $productid";
//     // $lt = oci_parse($conn, $query);
//     // oci_execute($lt);
//     // $result = oci_fetch_array($lt);
//     // echo $result;   
//     // if(isset($result[0])){
//     //     $offer_id = $result[0];
//     //     $sql = "SELECT OFFER_ID FROM OFFER_PRODUCT WHERE PRODUCT_ID = '$productid'";
//     //     $arr = oci_parse($conn, $sql);
//     //     oci_execute($arr); 
//     //     $offer_id = oci_fetch_array($arr)[0];
//     //     $sql = "UPDATE OFFER SET OFFER_NAME = '$offername' , OFFER_PERCENTAGE = '$offer' , OFFER_VALID_DATE = '$date' WHERE OFFER_ID = '$offer_id'";
//     //     $arr = oci_parse($conn, $sql);
//     //     oci_execute($arr); 
//     // }   
//     // else{
//     //     $sql = "INSERT INTO OFFER(OFFER_NAME,OFFER_PERCENTAGE, OFFER_VALID_DATE, FK_USER_ID, ITEMS) VALUES ('$offername', '$offer', '$date', '$trader','$pname')";
//     //     $arr = oci_parse($conn, $sql);
//     //     oci_execute($arr);
//     //     $sql = "SELECT OFFER_ID FROM OFFER WHERE ITEMS = '$pname' AND FK_USER_ID = '$trader'";
//     //     $arr = oci_parse($conn, $sql);
//     //     oci_execute($arr);
//     //     $offer_id = oci_fetch_array($arr)[0];
//     //     $sql = "INSERT INTO OFFER_PRODUCT(OFFER_ID , PRODUCT_ID) VALUES('$offer_id','$productid')";
//     //     $arr = oci_parse($conn, $sql);
//     //     oci_execute($arr);
        
        
//     // }


// }


if($_SERVER['REQUEST_METHOD'] == "POST"){
include("../connectionPHP/connect.php");
session_start();
$productid = $_GET['offerPro'];
echo $productid;
$date = $_GET['date'];
$offer = $_GET['offer'];
$trader = $_GET['traderid'];
$offername = $_GET['offername'];
$offer_id = $_GET['offerid'];
if(!empty($date) && !empty($offer) && !empty($trader) && !empty($offername) && !empty($offer_id)){
    $offername = $_GET['offername'];
    $offerpercent = $_GET['offer'];
    $offerdate = $_GET['date'];
    $offerproduct = $_GET['offer'];
    $offerid = $_GET['offerid'];
    $username = $_SESSION['traderusername'];
    // echo $_POST['offername2'];
    // echo  $_POST['offeradd2'];
    // echo $_POST['offerdate2'];
    // echo $_POST['protooffer'];


    $sql =  "SELECT NAME FROM PRODUCT WHERE PRODUCT_ID = '$productid'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $pname = oci_fetch_array($arr)[0];
          $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
          $arr = oci_parse($conn, $sql);
          oci_execute($arr);
          $trader_id = oci_fetch_array($arr)[0];  
          $query = "UPDATE OFFER SET OFFER_NAME = '$offername', OFFER_PERCENTAGE = $offerpercent, OFFER_VALID_DATE = '$offerdate' , ITEMS = '$pname' WHERE OFFER_ID = '$offer_id'";
          $arr = oci_parse($conn, $query);
          oci_execute($arr);
          // $sql2 = "SELECT OFFER_ID FROM OFFER WHERE ITEMS= '$pname' AND FK_USER_ID = '$trader_id'";
          // $arr2 = oci_parse($conn, $sql2);
          // oci_execute($arr2);
          // $offer_id = oci_fetch_array($arr2)[0];
          $query = "UPDATE OFFER_PRODUCT SET PRODUCT_ID = '$offerproduct' WHERE OFFER_ID = '$offerid'";
          $arr = oci_parse($conn, $query);
          oci_execute($arr);
          echo "OFFER SUCCESSFULLY Updated";
  }
  else{
    echo "cannot have empty fields!!";
  }


}


?>