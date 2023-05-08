<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    include("../connectionPHP/connect.php");
    $trader = $_GET['trader'];
    $sql = "SELECT * FROM SHOP WHERE TRADER_ID = $trader";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $result = array();
    while($rows = oci_fetch_array($arr)){
        $result[] = $rows;
    }
    echo json_encode($result);


}

?>




