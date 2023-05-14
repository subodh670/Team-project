<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include("../connectionPHP/connect.php");
    $status = $_GET['status'];
    $id = $_GET['id'];
    echo $id;
    if($status == 1){
        $sql = "UPDATE SHOP SET SHOP_STATUS = 0 WHERE SHOP_ID = $id";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
    }
    if($status == 0){
        $sql = "UPDATE SHOP SET SHOP_STATUS = 1 WHERE SHOP_ID = '$id'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
    }





}

















?>