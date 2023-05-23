<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include("../connectionPHP/connect.php");
    $id = $_GET['id'];
    $sql = "Delete FROM SHOP WHERE SHOP_ID = $id";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    
}
?>