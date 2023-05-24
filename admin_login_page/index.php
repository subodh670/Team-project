<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <?php
    session_start();
    if(isset($_SESSION['adusername'])){
        header("location: ../admindashboard/index.php");
    }
    ?>
    
        <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>
        <div class="form-box login1">
            <h2>Admin Sign In Page  </h2>
            <form action="" method="POST">
                <?php
                if(isset($_POST['submitlogin'])){
                    if(!empty($_POST['username']) && !empty($_POST['password'])){
                        $username = $_POST['username'];
                        $pass = $_POST['password'];
                        include("../connectionPHP/connect.php");
                        $sql = "SELECT USERNAME, PASSWORD, IMAGE, FIRST_NAME, LAST_NAME, REGISTERED_EMAIL, EMAIL,ROLE, USER_ID FROM MART_USER WHERE ROLE = 'admin'";
                        $array = oci_parse($conn, $sql);
                        oci_execute($array);
                        while($row = oci_fetch_array($array)){
                            if($username == $row[0] && $pass == $row[1]){
                                    $_SESSION['aid'] = $row[8];
                                    $_SESSION['adusername'] = $username;
                                    $_SESSION['adpassword'] = $pass;
                                    $_SESSION['adimage'] = $row[2];
                                    $_SESSION['adfirstname'] = $row[3];
                                    $_SESSION['adlastname'] = $row[4];
                                    $_SESSION['role'] =  $row[7];
                                    header("location: ../admindashboard/index.php");
                            }
                        }
                        echo "<p class='flasherror'>Login unsuccessfull !!  </p>";
                    }
                }

                ?>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <input type="text" name="username" required value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
                    <label>Username</label> 
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-open-outline"></ion-icon></span>
                    <input type="password" name="password" required >
                    <label>Password</label> 
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="checkremember">
                        Remember me </label>
                        <a href="#">Forgot Password</a>
                    
                </div>
                
                <button type="submit" class="btnLogin-popup" name="submitlogin">Login</button>
                <div class="login-register">
                <p>Don't have an account? <a href="register.php" class="register-link">Register</a></p>  

                </div>
            </form>
        </div>
    </div>
    <script src="app.js"></script>
</body>
</html>