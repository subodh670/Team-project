<?php



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include("../connectionPHP/connect.php");
    $ratings = $_GET['star'];
    $custname = $_GET['custname'];
    $proid = $_GET['proid'];
    $sql = "SELECT C_ID FROM CUSTOMER WHERE C_USERNAME = '$custname'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $c_id = oci_fetch_array($arr)[0];
    
    $sql4 = "SELECT RATING_ID FROM RATING WHERE PRODUCT_ID = $proid AND C_ID = $c_id";
    $result = oci_parse($conn, $sql4);
    oci_execute($result);
    $num = oci_fetch_array($result);
    if(isset($num[0])){
        $query = "UPDATE RATING SET RATING_STAR = '$ratings' WHERE PRODUCT_ID = $proid AND C_ID = $c_id";
        $arr3 = oci_parse($conn, $query);
        oci_execute($arr3);
    }
    else{
        $sql2 = "INSERT INTO RATING(RATING_STAR,PRODUCT_ID,C_ID) VALUES('$ratings', $proid, $c_id)";
        $arr2 = oci_parse($conn, $sql2);
        oci_execute($arr2);

    }


    

}



?>