<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        include("../connectionPHP/connect.php");
        $cname = $_GET['cname'];
        $pid = $_GET['pid'];
        $query = "SELECT C_ID FROM CUSTOMER WHERE C_USERNAME = '$cname'";
        $arr = oci_parse($conn, $query);
        oci_execute($arr);
        $custId = oci_fetch_array($arr)[0];
        $quant = $_GET['quant'];
        $saved = $_GET['saved'];
        echo $quant;
        echo $saved;
        $total = $quant + $saved;
        $query1 = "UPDATE PRODUCT SET PRODUCT_QUANTITY = $total WHERE PRODUCT_ID = $pid ";
        $arr2 = oci_parse($conn, $query1);
        oci_execute($arr2);
        $sql = "DELETE FROM CART WHERE C_ID = $custId AND PRODUCT_ID = $pid";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        oci_close($conn);
    }


?>




?>