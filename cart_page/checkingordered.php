<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    session_start();
    include("../connectionPHP/connect.php");
    $username = $_GET['name'];
    // echo $username;
    $sql = "SELECT C_ID FROM CUSTOMER WHERE C_USERNAME = '$username'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $c_id = oci_fetch_array($arr)[0];
    $pid = $_GET['pid'];
    $query = "SELECT ORDER_ID FROM ORDERS WHERE PRODUCT_ID = $pid AND C_ID = $c_id";
    $array = oci_parse($conn, $query);
    oci_execute($array);
    $row = oci_fetch_array($array);
    if(isset($row[0])){
        echo json_encode([true]);
    }
    else{
        echo json_encode([false]);
    }
}
?>