<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    

</head>
<body>
    <div class="backdrop">

    </div>
    <header>
        <div class="logo">
            <a href="../landing_page/index.php">
<img src="../landing_page/image1.png" alt="logo">

            </a>
        </div>
        <ul>
            <li><a href="../landing_page/index.php">Home</a></li>
            <li><a href="../traders_login_page/index.php">Sell a product</a></li>
            <li><a href="../about_page/index.php">About us</a></li>
            <li><a href="#contact_us">Contact Us</a></li>
        </ul>
        <div class="login_cart_search">
        <?php
        session_start();
        if(isset($_SESSION['username']) && isset($_SESSION['password'])){
            ?>
            <div class="login custprofile">
                <a href="../user_profile_page/index.php">
                    <img src="<?php echo '../images/'.$_SESSION['image']; ?>" alt="customer">
                </a> 
            </div>
            <?php
        }
        else{
            ?>
            <div class="login">
                <a href="../sign_in_page/index.php">Sign In</a>
             </div>
            <?php
        }


            ?>
             
             <div class="cart">
                <?php
                    include("../connectionPHP/connect.php");
                    if(isset($_SESSION['username'])){
                        $username = $_SESSION['username'];
                        $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
                        $array = oci_parse($conn, $sql);
                        oci_execute($array);
                        $cid = oci_fetch_array($array)[0];
                        $sql = "SELECT PRODUCT_CART.CART_ID, PRODUCT_CART.TOTAL_ITEMS FROM PRODUCT_CART INNER JOIN CART ON PRODUCT_CART.CART_ID=CART.CART_ID AND FK_USER_ID = $cid";
                        $array = oci_parse($conn, $sql);
                        oci_execute($array);
                        $totalnum = 0;
                        while($numbers = oci_fetch_array($array)){
                            $totalnum += $numbers[1];
                        }
                    
                    }
                    else{
                        include("../connectionPHP/connect.php");
                        if(isset($_COOKIE['product'])){
                            $id_cookie = $_COOKIE['product'];
                            $quantity_cookie = $_COOKIE['quantity'];
                            $arrid = explode(" ", $id_cookie);
                            $quantarr = explode(" ", $quantity_cookie);
                            $totalnum = 0;
                            for($i = 0; $i<count($arrid); $i++){
                                $totalnum += intval($quantarr[$i]);
                            }
                        }
                    }
                    ?>
                    <a href="../cart_page/index.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a><span class='cart-quantity'><?php if(isset($totalnum)) echo $totalnum; else echo "0"; ?></span>
                    <?php
                ?>        
             </div>
             <div class="search">
                <a href="#search-me"><i class="fa fa-search"></i></a>
             </div>
            
        </div>
    </header>
    <?php
                if(isset($_POST['subBtn'])){
                    if(!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['message'])){
                        $fullname = $_POST['fullname'];
                        $email = $_POST['email'];
                        $message = $_POST['message'];
                        $error1 = false;
                        $error = false;
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $error = "<p class='flashmessage'>Email is not a valid email!!</p>";
                            echo $error;
                            $error1 = true;
                        }
                        if(strlen($message)<20){
                            $error = "<p class='flashmessage'>Message should contain more than 20 letters</p>";
                            echo $error;
                            $error2 = true;
                        }
                        if($error1 == false && $error2 == false){
                            if(mail("cleckhfmart@gmail.com", "Contact message from user $email", $message)){
                                echo "mail sent";
                            }
                            else{
                                echo "unable to connect";
                            }
                            session_start();
                            $_SESSION['contact'] = true;    
                            header("location: ../landing_page/index.php");
                                      
                        }
                    }
                }
                
                ?>
<section class="contact-us-wrapper">
    <div class="container-form">
        <div class="contact-desc">
            <h1>Contact Us</h1>
            <p>We are solely representing our big shops in cleckhuddersfax and is united to help shops near to us in a proper manner. All our team is helping all the shops and the users who are free to give suggestion for this website. </p>
        </div>
        <div class="contact-form">
            <div class="our-info">
                <div class="info">
                    <i class="fa-sharp fa-solid fa-location-dot"></i>
                    <div class="info-item">
                        <h1>Address</h1>
                        <p>The British College, Thapathali, Kathmandu</p>
                    </div>
                </div>
                <div class="info">
                    <i class="fa-solid fa-phone"></i>
                    <div class="info-item">
                        <h1>Phone</h1>
                            <p>+9779841240401</p>
                    </div>
                </div>
                <div class="info">
                    <i class="fa-solid fa-envelope"></i>
                    <div class="info-item">
                        <h1>Email</h1>
                        <p>cleckhfmart@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="your-message-form">
                

                
                <h1 style="color: var(--secondary-color);">Send message</h1>
                <form action="" method="POST">
                    
                    <div class="form-fullname">
                        <label for="fullname">Full name</label>
                        <input type="text" id="fulname" name="fullname" value="<?php if(isset($_POST['fullname'])) echo $_POST['fullname']; ?>">
                    </div>
                    <div class="form-email">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                    </div>
                    <div class="your-message">
                        <label for="message">Your message</label>
                        <input type="text" id="message" name="message" value="<?php if(isset($_POST['message'])) echo $_POST['message']; ?>">
                    </div>
                    <div class="submit-btn">
                        <button type="submit" class="sub-btn" name="subBtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

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
</body>
</html>