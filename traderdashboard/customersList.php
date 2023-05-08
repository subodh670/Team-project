<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    include("../connectionPHP/connect.php");
    $trader = $_GET['trader'];
    $sql = "SELECT PRODUCT_NAME, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = $trader";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $result = array();
    while($row = oci_fetch_array($arr)){
        $result[] = $row;
        // var_dump($row);
    }
    echo json_encode($result);
}



?>