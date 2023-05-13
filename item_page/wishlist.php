<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    include("../connectionPHP/connect.php");
    $dataLove = $_GET['wish'];
    $prodId = $_GET['proid'];
    $custname = $_GET['custname'];
    $query = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$custname'";
    $arr = oci_parse($conn, $query);
    // if(!$arr){
    //     $m = oci_error($conn);
    //     echo $m;
    // }
    oci_execute($arr);
    $custId = oci_fetch_array($arr)[0];
    $sql = "SELECT NAME FROM PRODUCT WHERE PRODUCT_ID = $prodId";
    $array = oci_parse($conn, $sql);
    // if(!$array){
    //     $m = oci_error($conn);
    //     echo $m;
    // }
    oci_execute($array);
    $pname = oci_fetch_array($array)[0];
    // echo $prodId;
    // echo $pname;
    if($dataLove=='1'){
        $sql = "INSERT INTO WISHLIST(ITEMS, FK_USER_ID) VALUES ('$pname', '$custId')";
        $array = oci_parse($conn, $sql);
        // if(!$array){
        //     $m = oci_error($conn);
        //     echo $m;
        // }
        oci_execute($array);
        $sql = "SELECT WISHLIST_ID FROM WISHLIST WHERE ITEMS = '$pname' AND FK_USER_ID = '$custId'";
        $array = oci_parse($conn, $sql);
        // if(!$array){
        //     $m = oci_error($conn);
        //     echo $m;
        // }
        oci_execute($array);
        $wishlistid = oci_fetch_array($array)[0];
        // echo $wishlistid;
        $sql = "INSERT INTO WISHLIST_PRODUCT(PRODUCT_ID, WISHLIST_ID) VALUES($prodId, $wishlistid)";
        $array = oci_parse($conn, $sql);
        // if(!$array){
        //     $m = oci_error($conn);
        //     echo $m;
        // }
        oci_execute($array);
        oci_close($conn);
    }
    else{
        $sql = "SELECT WISHLIST_ID FROM WISHLIST WHERE ITEMS = '$pname' AND FK_USER_ID = '$custId'";
        $array = oci_parse($conn, $sql);
        // if(!$array){
        //     $m = oci_error($conn);
        //     echo $m;
        // }
        oci_execute($array);
        $wishlistid = oci_fetch_array($array)[0];
        $sql = "DELETE FROM WISHLIST WHERE ITEMS = '$pname' AND FK_USER_ID = '$custId'";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        
        $sql = "DELETE FROM WISHLIST_PRODUCT WHERE  WISHLIST_ID = '$wishlistid' AND PRODUCT_ID = '$prodId'";
        $array = oci_parse($conn, $sql);
        if(!$array){
            $m = oci_error($conn);
            echo $m;
        }
        oci_execute($array);
        oci_close($conn);
    }
}
?>

