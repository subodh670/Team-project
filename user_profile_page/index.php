<?php
include("../connectionPHP/inc_session.php");

// session_start();
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
<?php

if(isset($_POST['logout'])){
    session_destroy();
    session_start();
    $_SESSION['guest'] = false;
    header("location: ../landing_page/index.php");
}

?>

    <section class="userInfo">
        <p>Hello, <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></p>
        <h1>Manage my Account</h1>
        <img src="<?php echo '../images/'.$_SESSION['image']; ?>" alt="">
    </section>

    <section class="profilecontainer">
        <div class="dashprofile">
            <p data-go="profile">My profile</p>
            <p data-go='review'>My reviews</p>
            <p data-go="wish">My wishlist</p>
            <p data-go='order'>My orders</p>
        </div>
        <div class="dashitem1 dashitem" id="profile">
            <div class='profile-header'>
                <h3>personal profile</h3>
                <button>Edit Profile</button>
            </div>
            <div class="showuserdetail">
                <div class="userdetail useremail">
                    <p>Email</p>
                    <p>subodhacharya21@gmail.com</p>
                </div>
                <div class="userdetail username">
                    <p>Username</p>
                    <p>subodh21</p>
                </div>
                <div class="userdetail firstname">
                    <p>Firstname</p>
                    <p>Subodh</p>
                </div>
                <div class="userdetail lastname">
                    <p>lastname</p>
                    <p>Acharya</p>
                </div>
                <div class="userdetail mobile">
                    <p>Mobile</p>
                    <p>9841240401</p>
                </div>
                <div class="userdetail gender">
                    <p>Gender</p>
                    <p>Male</p>
                </div>
                <div class="userdetail address">
                    <p>Address</p>
                    <p>pepsicola</p>
                </div>
                <div class="userdetail password">
                    <p>Password</p>
                    <div>
                        <p>************</p>
                        <button>Change password</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashitem2 dashitem" id="review">
            <div class='profile-header'>
                <h3>product</h3>
                <p>Cheesecake</p>
                <img src="../productsImage/cheesecake2.jpg" alt="">
            </div>
            <div class="review-comment">
                <p>comment1</p>
                <button class="deletebtn">Delete</button>
            </div>
        </div>
        <div class="dashitem3 dashitem" id="wish">

        <!-- unfinished -->
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