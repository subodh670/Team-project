<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    include("../connectionPHP/connect.php");
    $trader = $_GET['trader'];
    $sql = "SELECT NAME, SHOP_ID FROM SHOP WHERE FK_USER_ID = '$trader'";
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