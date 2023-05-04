<?php

include("../connectionPHP/connect.php");
$id = $_GET['id'];
$sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = '$id'";
$arr = oci_parse($conn, $sql);
oci_execute($arr);
$finalarr = array();
while($rows = oci_fetch_array($arr)){
    $finalarr[] = $rows;
}

echo json_encode($finalarr);














?>