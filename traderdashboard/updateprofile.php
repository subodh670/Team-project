<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    session_start();
    $tid = $_GET['tid'];
    $name = $_GET['name'];
    $email = $_GET['email'];
    $firstname = $_GET['firstname'];
    $lastname = $_GET['lastname'];
    $mobile = $_GET['mobile'];
    $gender = $_GET['gender'];
    $address = $_GET['address'];
    // finding if email is changed
    $sql1 = "SELECT TRADER_EMAIL, TRADER_USERNAME, TRADER_MOBILE FROM TRADER WHERE TRADER_ID>$cid OR TRADER_ID < $tid";
    $array = oci_parse($conn, $sql1);
    oci_execute($array);
    $uniqueEmail = true;
    $uniqueName = true;
    $uniqueMobile = true;
    $changedEmail = false;


    while($row = oci_fetch_array($array)){
        if($email == $row[0]){
            $uniqueEmail = false;
        }
        if($name == $row[1]){
            $uniqueName = false;
        }
        if($mobile == $row[2]){
            $uniqueMobile = false;
        }
    }
    
    $sql2 = "SELECT TRADER_EMAIL FROM TRADER WHERE TRADER_ID = $tid";
    $valueArr = oci_parse($conn, $sql2);
    oci_execute($valueArr);
    $changedEmail = true ? oci_fetch_array($valueArr)[0] != $email : false;

    if($uniqueEmail && $uniqueName && $uniqueMobile){
        $_SESSION['username'] = $name;
        $_SESSION['firstname'] = $firstname;        
        $_SESSION['lastname'] = $lastname;
        
        $sql = "UPDATE TRADER SET TRADER_USERNAME = '$name' , TRADER_FIRSTNAME = '$firstname', TRADER_LASTNAME = '$lastname', TRADER_MOBILE = $mobile, TRADER_EMAIL = '$email', TRADER_GENDER = '$gender', TRADER_ADDRESS = '$address' WHERE TRADER_ID = $tid";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        if($changedEmail == true){
            $_SESSION['email'] = $email;
            $otpvalue = rand(100000,999999);
            $sql = "UPDATE TRADER SET C_OTP = '$otpvalue', TRADER_REGISTEREDEMAIL = 'no'";
            $array = oci_parse($conn, $sql);
            oci_execute($array);
            oci_close($conn);
            $message = "$firstname, your otp code is ". $otpvalue. " Thanks for joining our website. <br> Please do not share this code with anyone!!";

            mail("$email", "OTP code for cleckHFmart", $message);
           
            echo json_encode([true, true, true, true]);
        }
        else{
            echo json_encode([true, true, true, false]);
        }
    }   
    else{
        echo json_encode([$uniqueEmail, $uniqueName, $uniqueMobile, false]);
    }
    

}





?>