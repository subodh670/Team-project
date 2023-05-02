<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    session_start();
    include("../connectionPHP/connect.php");
    $username = $_GET['name'];
    // echo $username;
    $sql = "SELECT C_ID FROM CUSTOMER WHERE C_USERNAME = '$username'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $c_id = oci_fetch_array($arr)[0];
    $pid = $_GET['pid'];
    $quant = $_GET['quant'];
    // echo $quant;
    $slotArr = oci_parse($conn, "SELECT PRODUCT_QUANTITY FROM ORDERS");
    oci_execute($slotArr);
    $slotQ = 0;
    while($rows = oci_fetch_array($slotArr)){
        $slotQ += $rows[0];
    }
    $canAdd = $slotQ < 20 ? true:false;
    // echo $slotQ;
    // echo "<br>";
    // echo $canAdd;
    if($canAdd == true){
        $query = "UPDATE ORDERS SET PRODUCT_QUANTITY = $quant WHERE C_ID = $c_id AND PRODUCT_ID = $pid  ";
        $array = oci_parse($conn, $query);
        oci_execute($array);
        $query1 = "UPDATE CART SET P_QUANTITY = $quant WHERE C_ID = $c_id AND PRODUCT_ID = $pid ";
        $array2 = oci_parse($conn, $query1);
        oci_execute($array2);
        echo json_encode([true]);
    }
    else{
        echo json_encode([false]);
    }
}
?>