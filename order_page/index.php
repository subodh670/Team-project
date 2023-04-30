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
             <div class="login">
                <a href="../sign_in_page/index.html">Sign In</a>
             </div>
             <div class="cart">
            <a href="../cart_page/index.html"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
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
            $sql = "SELECT ORDERS.PRODUCT_QUANTITY, PRODUCT.PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_CATEGORY,PRODUCT_IMAGE2, PRODUCT.PRODUCT_QUANTITY FROM ORDERS,PRODUCT WHERE ORDERS.PRODUCT_ID = PRODUCT.PRODUCT_ID";
            


            ?>
        <div class="productsorder">
            <div class="img--info">
                <img src="https://images.pexels.com/photos/699122/pexels-photo-699122.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">
                <div class="info">
                    <p>Donuts</p>
                    <p>brand</p>
                    <p>only 10 items remaining</p>
                </div>
            </div>
            <div class="qty--price">
                <p>Qty :1</p>
                <p>Price: £20</p>
            </div>
        </div>
        <div class="productsorder">
            <div class="img--info">
                <img src="https://images.pexels.com/photos/699122/pexels-photo-699122.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">
                <div class="info">
                    <p>Donuts</p>
                    <p>brand</p>
                    <p>only 10 items remaining</p>
                </div>
            </div>
            <div class="qty--price">
                <p>Qty :1</p>
                <p>Price: £20</p>
            </div>
        </div>
        </div>
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