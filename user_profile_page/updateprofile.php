<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    include("../connectionPHP/connect.php");
    session_start();
    $cid = $_GET['cid'];
    $name = $_GET['name'];
    $email = $_GET['email'];
    $firstname = $_GET['firstname'];
    $lastname = $_GET['lastname'];
    $mobile = $_GET['mobile'];
    $gender = $_GET['gender'];
    $address = $_GET['address'];
    // finding if email is changed
    $sql1 = "SELECT C_EMAILADDRESS, C_USERNAME, C_MOBILE FROM CUSTOMER WHERE C_ID>$cid OR C_ID < $cid";
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
    
    $sql2 = "SELECT C_EMAILADDRESS FROM CUSTOMER WHERE C_ID = $cid";
    $valueArr = oci_parse($conn, $sql2);
    oci_execute($valueArr);
    $changedEmail = true ? oci_fetch_array($valueArr)[0] != $email : false;

    if($uniqueEmail && $uniqueName && $uniqueMobile){
        $_SESSION['username'] = $name;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        
        $sql = "UPDATE CUSTOMER SET C_USERNAME = '$name' , C_FIRSTNAME = '$firstname', C_LASTNAME = '$lastname', C_MOBILE = $mobile, C_EMAILADDRESS = '$email', C_GENDER = '$gender', C_ADDRESS = '$address' WHERE C_ID = $cid";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        if($changedEmail == true){
            $_SESSION['email'] = $email;
            $otpvalue = rand(100000,999999);
            $sql = "UPDATE CUSTOMER SET C_OTP = '$otpvalue', C_REGISTEREDEMAIL = 'no'";
            $array = oci_parse($conn, $sql);
            oci_execute($array);
            oci_close($conn);
            $message = "$firstname, your otp code is ". $otpvalue. " Thanks for joining our website. <br> Please do not share this code with anyone!!";

            mail("$email", "OTP code for cleckHFmart", $message);
           
            echo json_encode([true, true, true, true]);
        }
    }   
    else{
        echo json_encode([$uniqueEmail, $uniqueName, $uniqueMobile, false]);
    }
    

}





?>