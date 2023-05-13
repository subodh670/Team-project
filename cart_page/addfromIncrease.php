<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    session_start();
    include("../connectionPHP/connect.php");
    $username = $_GET['name'];
    // echo $username;
    $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $c_id = oci_fetch_array($arr)[0];
    $pid = $_GET['pid'];
    $quant = $_GET['quant'];
    $sql = "SELECT NAME FROM PRODUCT WHERE PRODUCT_ID = '$pid'";
    $array = oci_parse($conn, $sql);
    oci_execute($array);
    $pname = oci_fetch_array($array)[0];
    // echo $quant;
    $sql = "SELECT CART_ID FROM CART,PRODUCT WHERE CART.ITEMS = PRODUCT.NAME AND CART.FK_USER_ID = '$c_id' AND PRODUCT.PRODUCT_ID = '$pid'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $cart_id = oci_fetch_array($arr)[0];
    $slotArr = oci_parse($conn, "SELECT QUANTITY FROM PRODUCT_ORDER WHERE FK_CART_ID = '$cart_id'");
    oci_execute($slotArr);
    $slotQ = 0;
    while($rows = oci_fetch_array($slotArr)){
        $slotQ += $rows[0];
    }
    $canAdd = $slotQ <= 20 ? true:false;
    // echo $slotQ;
    // echo "<br>";
    // echo $canAdd;
    // echo $cart_id;
    if($canAdd == true){
        $query = "UPDATE PRODUCT_ORDER SET QUANTITY = $quant WHERE FK_CART_ID = '$cart_id'";
        $array = oci_parse($conn, $query);
        oci_execute($array);
        // $sql = "SELECT ORDER_ID FROM PRODUCT_ORDER WHERE FK_CART_ID = '$cart_id'";
        // $array = oci_parse($conn, $query);
        // oci_execute($array);
        // $order_id = oci_fetch_array($array)[0];
        $query1 = "UPDATE CART SET TOTAL_ITEMS = $quant WHERE FK_USER_ID = $c_id AND ITEMS = '$pname' ";
        $array2 = oci_parse($conn, $query1);
        oci_execute($array2);
        echo json_encode([true]);
    }
    else{
        echo json_encode([false]);
    }
}
?>