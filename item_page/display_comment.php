<?php



if($_SERVER['REQUEST_METHOD']=='POST'){
    include("../connectionPHP/connect.php");
    $pid = $_GET['pid'];
    $sql = "SELECT C_USERNAME, C_IMAGE, CREVIEW, REVIEW_ID FROM REVIEW, CUSTOMER WHERE REVIEW.C_ID = CUSTOMER.C_ID AND PRODUCT_ID = $pid ";
    $array = oci_parse($conn, $sql);
    oci_execute($array);
    $num = count(oci_fetch_array($array));
    $myarr = array();
    while($rows = oci_fetch_array($array)){
        $myarr[] = $rows;
    }
    if($num>0){
        echo json_encode($myarr);
    }
    else{
        echo json_encode([0]);
    }
}

?>