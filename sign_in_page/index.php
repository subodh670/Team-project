<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website with Login & registaration | Codehal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="../landing_page/index.php">
<img src="../landing_page/image1.png" alt="logo">

            </a>
        </div>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#sale">Sale a product</a></li>
            <li><a href="#customer_services">Customer Services</a></li>
            <li><a href="#contact_us">Contact Us</a></li>
        </ul>
        <div class="login_cart_search">
             <div class="login">
                <a href="/login">Sign In</a>
             </div>
             <div class="cart">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
             </div>
             <div class="search">
                <i class="fa fa-search"></i>
             </div>
                <form method="POST" action="" class="search-bar show-searchbar">
                    <input type="text" name="search" class="search-item">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    <button class="search-result"><i class="fa fa-search"></i></button>
                 </form>
            
        </div>
    </header>
    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>
        <div class="form-box login1">
            <h2>Signin</h2>
            <form action="#" method="POST">
                <?php

                if(isset($_POST['submitlogin'])){
                    if(!empty($_POST['username']) && !empty($_POST['password'])){
                        $username = $_POST['username'];
                        $pass = $_POST['password'];
                        include("../connectionPHP/connect.php");
                        $sql = "SELECT C_USERNAME, C_PASSWORD, C_IMAGE, C_FIRSTNAME, C_LASTNAME FROM CUSTOMER";
                        $array = oci_parse($conn, $sql);
                        oci_execute($array);
                        while($row = oci_fetch_array($array)){
                            if($username == $row[0] && $pass == $row[1]){
                                $_SESSION['username'] = $username;
                                $_SESSION['password'] = $pass;
                                $_SESSION['image'] = $row[2];
                                $_SESSION['firstname'] = $row[3];
                                $_SESSION['lastname'] = $row[4];
                                $_SESSION['guest'] = true;
                                header("location: ../landing_page/index.php");
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
                <p>Don't have an account? <a href="../sign_up_page/index.php" class="register-link">Register</a></p>  

                </div>
            </form>
        </div>
    </div>
    <footer>
        <div class="container-footer">
            <div class="footer-item1">
                <h1>CleckHF mart</h1>
                <p>Categories</p>
                <p>Products</p>
                <p>Customers Service</p>
                <p>Contact Us</p>
            </div>
            <div class="footer-item2">
                <h1>Privacy Policy</h1>
                <p>Payment</p>
                <p>FAQs</p>
                <p>Map</p>
                <img src="" alt="">
            </div>
            <div class="footer-item3">
                <h1>Social</h1>
                <p>Facebook</p>
                <p>Instagram</p>
                <p>Twitter</p>
            </div>
            <div class="footer-item4">
                <h1>Contact us</h1>
                <p>Location: </p>
                <p>London Uk</p>
                <p>Email: </p>
                <p>cleckhfmart@gmail.com</p>
            </div>

        </div>
    </footer>
    <script src="app.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>