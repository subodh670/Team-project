<?php



if($_SERVER['REQUEST_METHOD']=='POST'){
    $rate = $_GET['rate'];
    // echo $rate;
    //trader id, customer id, product id
    include("../connectionPHP/connect.php");
    $idpro = $_GET['idPro'];
    $sql = "SELECT USER_ID FROM PRODUCT, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND SHOP.FK_USER_ID = MART_USER.USER_ID AND PRODUCT_ID = '$idpro'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $trader_id = oci_fetch_array($arr)[0];
    $user_name = $_GET['c_username'];
    $sql1 = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$user_name'";
    $arr1 = oci_parse($conn, $sql1);
    oci_execute($arr1);
    $customer_id = oci_fetch_array($arr1)[0];
    $comment = $_GET['comment'];
    echo $comment."<br>";
    echo $idpro."<br>";
    echo $customer_id."<br>";
    echo $rate;
    $sql2 = "INSERT INTO REVIEW(REVIEW_DESCRIPTION, FK_PRODUCT_ID, FK_USER_ID, RATE,STATUS) VALUES('$comment', $idpro, $customer_id, '$rate',1)";
    $arr2 = oci_parse($conn, $sql2);
    oci_execute($arr2);
}


?>