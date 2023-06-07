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
    <div class="backdrop hidebackdrop">

    </div>
    <?php
// Set the HTML content for the invoice
$error = false;
if(isset($_POST['orderbtn'])){
    if(isset($_POST['postcollectdate']) && isset($_POST['posttimeslot']) && isset($_POST['postday'])){
        if(!empty($_POST['postcollectdate']) && !empty($_POST['posttimeslot']) && !empty($_POST['postday'])){
            $_SESSION['date'] = $_POST['postcollectdate'];
            $_SESSION['day'] = $_POST['postday'];
            $_SESSION['timeslot'] = $_POST['posttimeslot'];
            
            header("location: invoice.php");

        }
        else{
            $error = true;
        }
      
    }
    
    
}

// echo $htmlContent;
?>


    
   
    
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
            <li><a href="../about_us/index.php">About us</a></li>
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
    <?php if($error) echo "<p class='flashmessage2'>Collection slot is not chosen!!</p>" ?>  
    <p class="flashmessage"></p>  
    <div class="infoslots">
    <h3>About Collection Slots</h3>
    <p>According to cleckhfmart group collection slot can be fixed on day only after 24 hours of current date on wednesday , thursday and friday. The time slots are 10-13, 13-16 and 16-19. Thank You.</p>
</div>
            <div class="slots">
                <label style="font-size: 1.3rem;" for="slotscollection">Choose collection slot between days wed, Thu or Friday: </label>
                <input type="date" name="collection-slot" id="slotscollection">
                <select name="timeslot" style="color: white;" id="timeslot">
                    <option value="10-13">10-13</option>
                    <option value="13-16">13-16</option>
                    <option value="16-19">16-19</option>
                </select>
                <input type="hidden" class="disabledate" value="<?php if(isset($fixedDate) == true) echo "true"; else echo "false"; ?>">
                <input type="hidden" class='dayhidden' name="dayhidden">
                
                <p class="slotsday" name="slotsday"></p>
                <!-- <button name="fixtheday">Fix the day
                    
                </button> -->
                <p class="collectionday"></p>
            </div>

<section class="orderedItems">
    <div class="containerorder">
        <div class="orderslist">
            <?php
            include("../connectionPHP/connect.php");

            $username = $_SESSION['username'];
            $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
            $arr = oci_parse($conn, $sql);
            oci_execute($arr);
            $c_id = oci_fetch_array($arr)[0];
            $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$c_id'";
            $arr = oci_parse($conn, $sql);
            oci_execute($arr);
            $cartId = oci_fetch_array($arr)[0];
            // echo $c_id;
            // $sql = "SELECT CART_ID"
            // $sql = "SELECT PRODUCT_ORDER.QUANTITY, PRODUCT.NAME, PRODUCT.PRICE, CATEGORY.CATEGORY_NAME,PRODUCT.IMAGE2, PRODUCT.STOCK_AVAILABLE FROM PRODUCT_ORDER,PRODUCT,CATEGORY, CART WHERE PRODUCT_ORDER.FK_CART_ID = CART.CART_ID AND PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND PRODUCT.NAME = CART.ITEMS AND CART.FK_USER_ID = '$c_id'";
            // $sql = "SELECT ORDERED_PRODUCT.QUANTITY, PRODUCT.NAME, ORDERED_PRODUCT.TOTAL_COST, CATEGORY.CATEGORY_NAME,PRODUCT.IMAGE2, PRODUCT.STOCK_AVAILABLE FROM ORDERED_PRODUCT,PRODUCT,CATEGORY, CART, PRODUCT_ORDER WHERE ORDERED_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID AND PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND PRODUCT_ORDER.FK_CART_ID = CART.CART_ID AND PRODUCT_ORDER.ORDER_ID = ORDERED_PRODUCT.ORDER_ID AND CART.FK_USER_ID = '$c_id' AND PRODUCT_ORDER.STATUS = 1";
            $sql = "SELECT PRODUCT_CART.TOTAL_ITEMS, PRODUCT.NAME, PRODUCT.PRICE, CATEGORY.CATEGORY_NAME, PRODUCT.IMAGE2, PRODUCT.STOCK_AVAILABLE, PRODUCT_CART.CART_ID FROM PRODUCT_CART, PRODUCT,CATEGORY WHERE PRODUCT_CART.PRODUCT_ID = PRODUCT.PRODUCT_ID AND PRODUCT_CART.CART_ID = $cartId AND PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID";
            // $sql = "SELECT PRODUCT_ORDER.QUANTITY, PRODUCT.NAME, PRODUCT.PRICE, CATEGORY.CATEGORY_NAME,PRODUCT.IMAGE2, PRODUCT.STOCK_AVAILABLE FROM PRODUCT, CATEGORY INNER JOIN PRODUCT_ORDER, CART ON "
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
           
            <p class="collection_date">Collection slot: empty</p>
            
            <hr>
                <h1>Order summary</h1>
                <p class="totalitems">Items total: 5</p>
                <p class="totalpayment">Total payment: £35</p>
                <p class="tax">No taxes included</p>
                <form action="" method="POST">
                    <input type="hidden" class="postcollectdate" name="postcollectdate">
                    <input type="hidden" class="posttimeslot" name="posttimeslot">
                    <input type="hidden" class="postday" name="postday">
                    <button type="submit" class="orderbtn" name="orderbtn">Place order</button>
                </form>
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