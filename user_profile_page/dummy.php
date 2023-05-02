<?php    
            function validatePass($pass){
                $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
                if(preg_match($password_regex, $pass)){
                    return true;
                }
                else{
                    return false;   
                }
            }
            if(isset($_POST['updatepassbtn'])){
                include("../connectionPHP/connect.php");
                $username = $_SESSION['username'];
                echo $username;
                $sql = "SELECT C_PASSWORD FROM CUSTOMER WHERE C_USERNAME = '$username'";
                $arr = oci_parse($conn, $sql);
                oci_execute($arr);
                $pass = oci_fetch_array($arr)[0];
                $oldpass = sha1($_POST['oldpass']);
                $newpass = $_POST['newpass'];
                $cpass = $_POST['cpass'];
                $errornewPass = null;
                $errorconfirmpass = null;
                if($pass == $oldpass){
                    if(validatePass($newpass)){
                        if($newpass == $cpass){
                            $newpass = sha1($newpass);
                            $sql = "INSERT INTO CUSTOMER(C_PASSWORD) VALUES('$newpass') WHERE C_USERNAME = '$username'";
                            $array = oci_parse($conn, $sql);
                            oci_execute($array);
                            $_SESSION['password'] = $newpass;
                            $_SESSION['changep'] = true;
                        }
                        else{
                            $_SESSION['errorconfirm'] = true;
                            $errorconfirmpass = "<p>Error: Passwords do not match!!</p>";

                        }
                    }
                    else{
                        $_SESSION['errorvalidpass'] = true;
                        $errornewPass = "<p>Error: Password must be 8 characters, one uppercase, one lowercase, one digit and one special character!!</p>";
    
                    }
                }   
                else{
                    $_SESSION['matchpass'] = true;
                }
    
            }
            

            ?>