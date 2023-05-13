<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    $id = $_GET['id'];
    $sql = "DELETE FROM REVIEW WHERE REVIEW_ID = '$id'";
    $array = oci_parse($conn, $sql);
    oci_execute($array);












}

?>