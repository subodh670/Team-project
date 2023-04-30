<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    include("../connectionPHP/connect.php");
    $id = $_GET['commentid'];
    $sql = "DELETE FROM REVIEW WHERE REVIEW_ID = $id";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    echo json_encode($arr);
}



?>