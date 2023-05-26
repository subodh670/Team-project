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
        echo "MEEE";

        // echo $pName;
        // echo $pid;
        // $total = $quant + $saved;
        // $query1 = "UPDATE PRODUCT SET PRODUCT_QUANTITY = $total WHERE PRODUCT_ID = $pid ";
        // $arr2 = oci_parse($conn, $query1);
        // oci_execute($arr2);
        // echo $pName;
        // echo $custId;
        $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$custId' ";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        // var_dump(oci_fetch_array($array));
        // while($rows = oci_fetch_array($array)){
        //     echo $rows[0];
        //     // echo $rows[1];
        // }
        $cart_id = oci_fetch_array($array)[0];
        // $order_id = oci_fetch_array($array)[0];
        
        $sql = "DELETE FROM CART WHERE CART_ID='$cart_id'";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        // echo $custId;
        // echo $pid;
        
        $sql = "SELECT ORDER_ID FROM PRODUCT_ORDER, COLLECTION_SLOT WHERE COLLECTION_SLOT.SLOT_ID = PRODUCT_ORDER.FK_SLOT_ID AND PRODUCT_ORDER.FK_CART_ID = '$cart_id' AND COLLECTION_SLOT.STATUS = 1";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        $o_id = oci_fetch_array($array);
        if(isset($o_id[0])){
            $order_id = $o_id[0];
            echo "HELLO";
            // $sql2 = "DELETE FROM PRODUCT_ORDER WHERE FK_CART_ID = '$cart_id'";
            // $array4 = oci_parse($conn, $sql2);
            // oci_execute($array4);
            $sql = "DELETE FROM ORDERED_PRODUCT WHERE ORDER_ID = '$order_id' AND PRODUCT_ID = '$pid'";
            $array4 = oci_parse($conn, $sql2);
            oci_execute($array4);
            oci_close($conn);
        }
        
    }


?>