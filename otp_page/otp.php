<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    session_start();
    $email = $_GET['email'];
    // $email = 'subodhacharya21@gmail.com';
    include("../connectionPHP/connect.php");
    $sql = "SELECT OTP FROM MART_USER WHERE EMAIL = '$email' AND ROLE = 'customer'";
    $array = oci_parse($conn, $sql);
    oci_execute($array);
    $row = oci_fetch_array($array);
    $arr = $row[0];
    echo json_encode($arr);
}

?>