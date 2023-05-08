<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include("../connectionPHP/connect.php");
    $status = $_GET['status'];
    $id = $_GET['id'];
    echo $id;
    if($status == 'enable'){
        $sql = "UPDATE SHOP SET SHOP_STATUS = 'disabled' WHERE SHOP_ID = $id";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
    }
    if($status == 'disable'){
        $sql = "UPDATE SHOP SET SHOP_STATUS = 'enabled' WHERE SHOP_ID = '$id'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
    }





}

















?>