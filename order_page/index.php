<?php
    include("../connectionPHP/inc_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order page</title>
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
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
            <li><a href="../landing_page/image1.png">Home</a></li>
            <li><a href="../traders_login_page/index.php">Sale a product</a></li>
            <li><a href="">Customer Services</a></li>
            <li><a href="../contact_us/index.php">Contact Us</a></li>
        </ul>
        <div class="login_cart_search">
        <?php
        // session_start();
        // include("../connectionPHP/inc_session.php");
        // session_start();
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



<section class="orderedItems">
    <div class="containerorder">
        <div class="orderslist">
            <?php
            include("../connectionPHP/connect.php");

            $username = $_SESSION['username'];
            $sql = "SELECT C_ID FROM CUSTOMER WHERE C_USERNAME = '$username'";
            $arr = oci_parse($conn, $sql);
            oci_execute($arr);
            $c_id = oci_fetch_array($arr)[0];
            $sql = "SELECT ORDERS.PRODUCT_QUANTITY, PRODUCT.PRODUCT_NAME, PRODUCT.PRODUCT_PRICE, PRODUCT.PRODUCT_CATEGORY,PRODUCT.PRODUCT_IMAGE2, PRODUCT.PRODUCT_QUANTITY FROM ORDERS,PRODUCT WHERE ORDERS.PRODUCT_ID = PRODUCT.PRODUCT_ID AND ORDERS.C_ID = '$c_id'";
            $arr = oci_parse($conn, $sql);
            oci_execute($arr);
            while($row = oci_fetch_array($arr)){
                $orderQuant = $row[0];
                $productName = $row[1];
                $productPrice = $row[2];
                $productCategory = $row[3];
                $productImage = $row[4];
                $productQuant = $row[5];


                ?>
        <div class="productsorder">
            <div class="img--info">
                <img src="../productsImage/<?php echo $productImage; ?>" alt="">
                <div class="info"> 
                    <p><?php echo $productName; ?></p>
                    <p><?php echo $productCategory; ?></p>
                    <p>only <?php echo $productQuant; ?> items remaining</p>
                </div>
            </div>
            <div class="qty--price">
                <p>Qty :<?php echo $orderQuant; ?></p>
                <p>Price: £<?php echo $productPrice; ?></p>
            </div>
        </div>

                <?php
            }


            ?>
            </div>
            <input type="hidden" class="hiddencustomer" value="<?php echo $_SESSION['username']; ?>">
        <div class="placeorder">
            <p>Collection place: huddersfields</p>
            <hr>
                <h1>Order summary</h1>
                <p class="totalitems">Items total: 5</p>
                <p class="totalpayment">Total payment: £35</p>
                <p class="tax">All taxes included</p>
                <button class="orderbtn">Place order</button>
           

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