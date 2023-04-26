<?php


// echo $rows;
if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $sql = "SELECT * FROM PRODUCT";
    $array = oci_parse($conn, $sql);
    oci_execute($array);
    $rows = oci_fetch_all($array, $a);
    echo json_encode($a);
}

?>