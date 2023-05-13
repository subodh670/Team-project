<?php



if($_SERVER['REQUEST_METHOD']=='POST'){
    include("../connectionPHP/connect.php");
    $pid = $_GET['pid'];
    $sql = "SELECT USERNAME, IMAGE, REVIEW_DESCRIPTION, REVIEW_ID,REVIEW.RATE FROM REVIEW, MART_USER WHERE REVIEW.FK_USER_ID = MART_USER.USER_ID AND FK_PRODUCT_ID = $pid AND MART_USER.REGISTERED_EMAIL = 'yes'";
    $array = oci_parse($conn, $sql);
    oci_execute($array);
    $num = 0;
    $myarr = array();
    while($rows = oci_fetch_array($array)){
        $myarr[] = $rows;
        $num++;
    }
    if($num>0){
        echo json_encode($myarr);
    }
    else{
        echo json_encode([]);
    }
}

?>