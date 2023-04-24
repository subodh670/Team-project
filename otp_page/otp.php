<?php
session_start();
$email = $_GET['email'];
// $email = 'subodhacharya21@gmail.com';
include("../connectionPHP/connect.php");
$sql = "SELECT C_OTP FROM CUSTOMER WHERE C_EMAILADDRESS = '$email'";
$array = oci_parse($conn, $sql);
oci_execute($array);
$row = oci_fetch_array($array);
$arr = $row[0];
echo json_encode($arr);


?>