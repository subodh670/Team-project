<?php



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include("../connectionPHP/connect.php");
    $sql4 = "SELECT RATING_STAR FROM RATING, REVIEW WHERE  PRODUCT_ID = $proid";
    $result = oci_parse($conn, $sql4);
    oci_execute($result);
    $num = oci_fetch_array($result);
    $count = count(oci_fetch_array($result));
    if($count>0){
        $arr = array();
        while($row = $count){
            $arr[] = $row;
        }
        echo json_encode($arr);
    }
    else{
        echo json_encode([0]);
    }


}

?>