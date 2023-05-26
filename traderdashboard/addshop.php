<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include("../connectionPHP/connect.php");
    $name = $_GET['name'];
    $address = $_GET['address'];
    $contact = $_GET['contact'];
    // $username = $_SESSION['traderusername'];
    // $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
    // $arr = oci_parse($conn, $sql);
    // oci_execute($arr);
    // $trader_id = oci_fetch_array($arr)[0];
    $trader_id = $_GET['trader'];
    // echo $username;
    $sql = "INSERT INTO SHOP(NAME, ADDRESS, CONTACT_NUMBER, SHOP_STATUS, FK_USER_ID) VALUES('$name', '$address','$contact',1, '$trader_id')";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    
}
?>