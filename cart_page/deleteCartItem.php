<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        include("../connectionPHP/connect.php");
        $cname = $_GET['cname'];
        $pid = $_GET['pid'];
        $pName = $_GET['pName'];
        $query = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$cname'";
        $arr = oci_parse($conn, $query);
        oci_execute($arr);
        $custId = oci_fetch_array($arr)[0];
        $quant = $_GET['quant'];
        $saved = $_GET['saved'];
        // $total = $quant + $saved;
        // $query1 = "UPDATE PRODUCT SET PRODUCT_QUANTITY = $total WHERE PRODUCT_ID = $pid ";
        // $arr2 = oci_parse($conn, $query1);
        // oci_execute($arr2);
        $sql = "SELECT CART_ID, ORDER_ID FROM CART, PRODUCT_ORDER WHERE CART.CART_ID = PRODUCT_ORDER.FK_CART_ID AND ITEMS = '$pName' AND FK_USER_ID = '$custId' ";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        $cart_id = oci_fetch_array($array)[0];
        $order_id = oci_fetch_array($array)[1];

        $sql = "DELETE FROM CART WHERE CART_ID='$cart_id'";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        echo $custId;
        echo $pid;
        $sql2 = "DELETE FROM PRODUCT_ORDER WHERE FK_CART_ID = '$cart_id'";
        $array4 = oci_parse($conn, $sql2);
        oci_execute($array4);
        $sql = "DELETE FROM ORDERED_PRODUCT WHERE ORDER_ID = '$order_id' AND PRODUCT_ID = '$pid'";
        $array4 = oci_parse($conn, $sql2);
        oci_execute($array4);
        oci_close($conn);
    }


?>

