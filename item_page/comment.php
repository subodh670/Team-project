<?php



if($_SERVER['REQUEST_METHOD']=='POST'){
    //trader id, customer id, product id
    include("../connectionPHP/connect.php");
    $idpro = $_GET['idPro'];
    $sql = "SELECT TRADER_ID FROM PRODUCT WHERE PRODUCT_ID = '$idpro'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $trader_id = oci_fetch_array($arr)[0];
    $user_name = $_GET['c_username'];
    $sql1 = "SELECT C_ID FROM CUSTOMER WHERE C_USERNAME = '$user_name'";
    $arr1 = oci_parse($conn, $sql1);
    oci_execute($arr1);
    $customer_id = oci_fetch_array($arr1)[0];
    $comment = $_GET['commentid'];
    $sql2 = "INSERT INTO REVIEW(REVIEW_ID,CREVIEW, PRODUCT_ID, C_ID, TRADER_ID) VALUES('','$comment', $idpro, $customer_id, $trader_id)";
    $arr2 = oci_parse($conn, $sql2);
    oci_execute($arr2);
}


?>