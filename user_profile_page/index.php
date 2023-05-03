<?php
include("../connectionPHP/inc_session.php");
// session_start();
?>
<?php
    if(isset($_POST['logout'])){
        session_destroy();
        session_start();
        $_SESSION['guest'] = false;
        header("location: ../landing_page/index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <title>User profile page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="backdrop hidebackdrop">

    </div>
    <div class="updatepass hidepass" >
        <form action="" method="POST">
            <div class="xmark1">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <?php    
            $errornewPass = "";
            $errorconfirmass = "";
            $flashvalidated = "";
            $errornotmatch = "";
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
                
                if($pass == $oldpass){
                    if(validatePass($newpass)){
                        if($newpass == $cpass){
                            $newpass = sha1($newpass);
                            $sql = "INSERT INTO CUSTOMER(C_PASSWORD) VALUES('$newpass') WHERE C_USERNAME = '$username'";
                            $array = oci_parse($conn, $sql);
                            oci_execute($array);
                            $_SESSION['password'] = $newpass;
                            $flashvalidated = "<p>Password updated!!</p>";
                        }
                        else{
                            // $_SESSION['errorconfirm'] = true;
                            $errorconfirmpass = "<p>Error: Passwords do not match with the database</p>";

                        }
                    }
                    else{
                        // $_SESSION['errorvalidpass'] = true;
                        $errornewPass = "<p>Error: Password must be 8 characters, one uppercase, one lowercase, one digit and one special character!!</p>";

    
                    }
                }   
                else{
                    // $_SESSION['matchpass'] = true;
                    $errornotmatch = "<p>Passwords do not match!!</p>";
                    
                }
    
            }
            

            ?>
            <h3>Update password</h3>
            <div class="oldpassword">
                <i class="fa-solid fa-envelope"></i>
                <input type="password" name="oldpass" placeholder="old password">
                <p class='errorpass'></p>
            </div>
            <div class="newpassword">
                <i class="fa-solid fa-envelope"></i>
                <input type="password" name="newpass" placeholder="new password">
                <p class='errorpass'></p>
            </div>
            <div class="confirmpass">
                <i class="fa-solid fa-envelope"></i>
                <input type="password" name="cpass" placeholder="confirm password">
                <p class='errorpass'></p>
            </div>
            <div class="updatebtn">
                <button type="submit" name="updatepassbtn">Update</button>
            </div>

        </form>
    </div>
    <div class="editprofile hideEditprofile">
        <form method="POST" action="">
        <!-- <span>&times;</span> -->
        <div class="xmark">
            <i class="fa-solid fa-xmark"></i>
        </div>
            <h3>Update Profile</h3>
            <?php 
            $username = $_SESSION['username'];
            include("../connectionPHP/connect.php");
            $sql = "SELECT * FROM CUSTOMER WHERE C_USERNAME = '$username'";
            $arr = oci_parse($conn, $sql);
            oci_execute($arr);
            while($rows = oci_fetch_array($arr)){
                $username = $rows[1];
                $firstname = $rows[2];
                $lastname = $rows[3];
                $mobile = $rows[4];
                $email = $rows[5];
                $gender = $rows[6];
                $address = $rows[7];
                $cid = $rows[0];

                ?>
            <div class="editusername">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="username" placeholder="username" value="<?php echo $username ?>">
                <p class='errorusername'></p>

            </div>
            <input type="hidden" class='chidden' value="<?php echo $cid; ?>">
            <div class="editemail">
                <i class="fa-solid fa-envelope"></i>
                <input type="text" name="useremail" placeholder="email"  value="<?php echo $email ?>">
                <p class='erroremail'></p>

            </div>
            <div class="editfirstname">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="firstname" placeholder="firstname"  value="<?php echo $firstname ?>">
            </div>
            <div class="editlastname">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="lastname" placeholder="lastname"  value="<?php echo $lastname ?>">
            </div>
            <div class="editmobile">
                <i class="fa-solid fa-phone"></i>
                <input type="number" name="mobile" placeholder="mobile number"  value="<?php echo $mobile ?>">
                <p class='errormobile'></p>

            </div>
            <div class="editgender">
                <i class="fa-regular fa-user"></i>
                <select name="gender" id="gender">
                    <option value="male">male</option>
                    <option value="female">female</option>
                </select>
            </div>
            <div class="editaddress">
                <i class="fa-solid fa-house"></i>
                <input type="text" name="address" placeholder="address"  value="<?php echo $address ?>">
            </div>
            <div class="updatebtn2">
                <button type="button" name="update">Update Details</button>
            </div>

                <?php
            }

            ?>
        </form>
    </div>
    <header>
        <div class="logo">
            <a href="../landing_page/index.php">
<img src="../landing_page/image1.png" alt="logo">

            </a>
        </div>
        <ul>
            <li><a href="../landing_page/index.php">Home</a></li>
            <li><a href="../traders_login_page/index.php">Sale a product</a></li>
            <li><a href="">Customer Services</a></li>
            <li><a href="../contact_us/index.php">Contact Us</a></li>
        </ul>
        <div class="login_cart_search">
             <form class="login" method="POST" action="">
                
                <button name='logout'>Log out</button>
             </form>
             <div class="cart">
             <?php
                    include("../connectionPHP/connect.php");
                    if(isset($_SESSION['username'])){
                        $username = $_SESSION['username'];
                        $sql = "SELECT P_QUANTITY FROM CART,CUSTOMER WHERE CART.C_ID= CUSTOMER.C_ID AND C_USERNAME = '$username'";
                        $array = oci_parse($conn, $sql);
                        oci_execute($array);
                        $totalnum = 0;
                        while($numbers = oci_fetch_array($array)){
                            $totalnum += $numbers[0];
                        }
                    
                    }
                    ?>
                    <a href="../cart_page/index.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a><span><?php if(isset($totalnum)) echo $totalnum; else echo "0"; ?></span>
                    <?php
                ?>
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


    <section class="userInfo">
        <p>Hello, <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></p>
        <h1>Manage my Account</h1>
        <img src="<?php echo '../images/'.$_SESSION['image']; ?>" alt="">
    </section>
    <section class="errorsflash">
    <?php
        if($errorconfirmass != "" && $errorconfirmass != "" && $flashvalidated!= "" && $errornotmatch != "" ){
            echo $errornewPass;
            echo $errorconfirmpass;
            echo $flashvalidated;
            echo $errornotmatch;
        }

?>
    </section>


    <section class="profilecontainer">
        <div class="dashprofile">
            <h4 style="color: var(--tertiary-color); font-weight: bolder;">My Account</h4>
            <p data-go="profile">My profile</p>
            <p data-go='review'>My reviews</p>
            <p data-go="wish">My wishlist</p>
            <p data-go='order'>My orders</p>
        </div>
        <div class="dashitem1 dashitem" id="profile">
            <?php 
            $username = $_SESSION['username'];
            // echo $_SESSION['username'];

            include("../connectionPHP/connect.php");
            $sql = "SELECT * FROM CUSTOMER WHERE C_USERNAME = '$username'";
            $arr = oci_parse($conn, $sql);
            oci_execute($arr);
            while($rows = oci_fetch_array($arr)){
                $username = $rows[1];
                $firstname = $rows[2];
                $lastname = $rows[3];
                $mobile = $rows[4];
                $email = $rows[5];
                $gender = $rows[6];
                $address = $rows[7];
                ?>
            <div class='profile-header'>
                <h3>personal profile</h3>
                <button class="editbtntrigger">Edit Profile</button>
            </div>
            <div class="showuserdetail">
                <div class="userdetail useremail">
                    <p>Email</p>
                    <p><?php echo $email; ?></p>
                </div>
                <div class="userdetail username">
                    <p>Username</p>
                    <p><?php echo $username; ?></p>
                </div>
                <div class="userdetail firstname">
                    <p>Firstname</p>
                    <p><?php echo $firstname; ?></p>
                </div>
                <div class="userdetail lastname">
                    <p>lastname</p>
                    <p><?php echo $lastname; ?></p>
                </div>
                <div class="userdetail mobile">
                    <p>Mobile</p>
                    <p><?php echo $mobile; ?></p>
                </div>
                <div class="userdetail gender">
                    <p>Gender</p>
                    <p><?php echo $gender; ?></p>
                </div>
                <div class="userdetail address">
                    <p>Address</p>
                    <p><?php echo $address; ?></p>
                </div>
                <div class="userdetail password">
                    <p>Password</p>
                    <div>
                        <p>************</p>
                        <button class="changepassbtn">Change password</button>
                        
                    </div>
                </div>
            </div>

            <?php
            }
            
            ?>
            
        </div>
        <div class="dashitem2 dashitem" id="review">
            <?php 
            include("../connectionPHP/connect.php");
            $username = $_SESSION['username'];
            $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_IMAGE2, CREVIEW, PRODUCT.PRODUCT_ID FROM REVIEW, PRODUCT, CUSTOMER WHERE REVIEW.PRODUCT_ID = PRODUCT.PRODUCT_ID AND REVIEW.C_ID = CUSTOMER.C_ID AND CUSTOMER.C_USERNAME = '$username'";
            $array = oci_parse($conn, $sql);
            oci_execute($array);
            
            while($rows = oci_fetch_array($array)){
                $pname = $rows[0];
                $pprice = $rows[1];
                $pQuant = $rows[2];
                $pImage = $rows[3];
                $cReview = $rows[4];
                $pid = $rows[5];
                ?>
            <div class='profile-header'>
                <h3>Product</h3>
                <p><a href="<?php echo "../item_page/index.php?id=".$pid;?>"><?php  echo $pname; ?></a></p>
                <img src="../productsImage/<?php echo $pImage;  ?>" alt="">
            </div>
            <div class="review-comment">
                <p><?php echo $cReview; ?></p>
                <button class="deletebtn">Delete</button>
            </div>


                <?php

            }
            
            ?>
            
        </div>
        <div class="dashitem3 dashitem" id="wish">
            <div class='wishitem'>
                <h3>Watchlist</h3>
                <?php  
                
                    include("../connectionPHP/connect.php");
                    $username = $_SESSION['username'];
                    $sql = "SELECT WISHLIST_ID, PRODUCT_NAME,PRODUCT_QUANTITY, PRODUCT_IMAGE2, PRODUCT_PRICE, PRODUCT.PRODUCT_ID, CUSTOMER.C_ID FROM WISHLIST, PRODUCT, CUSTOMER WHERE WISHLIST.PRODUCT_ID = PRODUCT.PRODUCT_ID AND WISHLIST.C_ID = CUSTOMER.C_ID AND CUSTOMER.C_USERNAME = '$username'";
                    $arr = oci_parse($conn, $sql);
                    oci_execute($arr);
                    while($rows = oci_fetch_array($arr)){
                        $wishlist_id = $rows[0];
                        $productName = $rows[1];
                        $productQuantity = $rows[2];
                        $productImage= $rows[3];
                        $productPrice= $rows[4];

                    ?>
                <div class='wish'>
                    <img src="../productsImage/<?php echo $productImage; ?>" alt="">
                    <div class="titlewish">
                        <p><?php echo $productName.", ".$productQuantity; ?> counts</p>
                        <i class="fa-solid fa-trash-can"></i>
                    </div>
                    <h3><?php echo $productPrice;  ?></h3>
                    <button class="wishtocartbtn">Add to cart</button>
                </div>

                    <?php
                    }
                
                
                ?>
                
            </div>
        </div>
        <div class="dashitem4 dashitem" id="order">
            <!-- unfinished -->
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