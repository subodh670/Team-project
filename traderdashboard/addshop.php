<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include("../connectionPHP/connect.php");
    $name = $_GET['name'];
    $cat = $_GET['category'];
    $contact = $_GET['contact'];
    $trader = 1029;
    $sql = "INSERT INTO SHOP(NAME, ADDRESS, CONTACT_NUMBER, SHOP_STATUS, FK_USER_ID) VALUES('$name', '$cat','$contact',1, '$trader')";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    
}
?>