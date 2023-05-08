<?php



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include("../connectionPHP/connect.php");
    $ratings = $_GET['star'];
    $custname = $_GET['custname'];
    $proid = $_GET['proid'];
    $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$custname'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $c_id = oci_fetch_array($arr)[0];
    
    $sql4 = "SELECT REVIEW_ID FROM REVIEW WHERE FK_PRODUCT_ID = $proid AND FK_USER_ID = $c_id";
    $result = oci_parse($conn, $sql4);
    oci_execute($result);
    $num = oci_fetch_array($result);
    if(isset($num[0])){
        $query = "UPDATE REVIEW SET RATE = '$ratings' WHERE FK_PRODUCT_ID = $proid AND FK_USER_ID = $c_id";
        $arr3 = oci_parse($conn, $query);
        oci_execute($arr3);
    }
    else{
        $sql2 = "INSERT INTO REVIEW(RATE,FK_PRODUCT_ID,FK_USER_ID) VALUES('$ratings', $proid, $c_id)";
        $arr2 = oci_parse($conn, $sql2);
        oci_execute($arr2);

    }


    

}



?>