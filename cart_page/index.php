<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="style.css">
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
        <?php
        // session_start();
        // include("../connectionPHP/inc_session.php");
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
                        // $sql = "SELECT P_QUANTITY FROM CART,CUSTOMER WHERE CART.C_ID= CUSTOMER.C_ID AND C_USERNAME = '$username'";
                        $sql = "SELECT TOTAL_ITEMS FROM CART,MART_USER WHERE CART.FK_USER_ID= MART_USER.USER_ID AND USERNAME = '$username'";
                        $array = oci_parse($conn, $sql); 
                        oci_execute($array);
                        $totalnum = 0;
                        while($numbers = oci_fetch_array($array)){
                            $totalnum += $numbers[0];
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
    <?php
    if(isset($_COOKIE['product']) || isset($_COOKIE['quantity'])){
        $id_cookie = $_COOKIE['product'];
        $quantity_cookie = $_COOKIE['quantity'];
        ?>
        <input type="hidden" class="idcookie" value="<?php echo $id_cookie; ?>">
        <input type="hidden" class="idquant" value="<?php  echo $quantity_cookie;  ?>">
        
        <?php
    }



?>


<!-- <section class="selectall">
        <div class="all">
            <input type="checkbox" name="selectallpro">
            <p>Select all items(0 items)</p>
        </div>
        <div class="delete">
            <i class="fa-solid fa-trash-can"></i>
            <span>Delete</span>
        </div>
</section> -->

            <div class="slots">
                <label for="slotscollection">Choose collection slot: </label>
                <select name="collection-slot" id="slotscollection">
                    <option value="10-13">10-13</option>
                    <option value="13-16">13-16</option>
                    <option value="16-19">16-19</option>

                </select>
            </div>
<main></main>
<?php
if(isset($_SESSION['username'])){
?>
    <input class='usernameFind' type="hidden" value="<?php echo $_SESSION['username']?>">
    <?php
}
?>
<!-- <section class="oneitemselect"> 
    <input type="hidden" value="${productId}" class="getproductid">
    <div class="selectone">
        <div class="onlyone">
            <p>Uk bakery shop</p>
        </div>
    </div>
    <div class="productselect">
        <div class="onlyone">
            <input type="checkbox" name="secselect" class="orderitem">
            <div class="product-desc">
                <img src="https://images.pexels.com/photos/699122/pexels-photo-699122.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">
                <div class="desc">
                    <p class="itempro">Donuts</p>
                    <p>no brand</p>
                    <p>only 10 items remaining</p>
                </div>
            </div>
        </div>
        <div class="price--qty">
            <div class="wish_price_del">
                <p>Rs: £20</p>
                <div>
                    <i class="fa-regular fa-heart show-heart"></i>
                    <i class="fa-solid fa-heart show-heart-solid"></i>
                    <i class="fa-solid fa-trash-can"></i>

                    <i></i>
                </div>
            </div>
            <div class="countitem">
                <button class="decrease">-</button>
              <input type="text" value="1">
              <button class="increase">+</button>
            </div>
        </div>
    </div>
</section>


<section class="oneitemselect">
    <div class="selectone">
        <div class="onlyone">
            <input type="checkbox" name="mainselectall" >
            <p>Uk Butcher shop</p>
        </div>
    </div>
    <div class="productselect">
        <div class="onlyone">
            <input type="checkbox" name="secselect" class="orderitem">
            <div class="product-desc">
                <img src="https://plus.unsplash.com/premium_photo-1674389878114-6a5479a7b86c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="">
                <div class="desc">
                    <p>Donuts</p>
                    <p>no brand</p>
                    <p>only 10 items remaining</p>
                </div>
            </div>
        </div>
        <div class="price--qty">
            <div class="wish_price_del">
                <p>Rs: £20</p>
                <div>
                    <i class="fa-regular fa-heart show-heart"></i>
                    <i class="fa-solid fa-heart show-heart-solid"></i>
                    <i class="fa-solid fa-trash-can"></i>

                    <i></i>
                </div>
            </div>
            <div class="countitem">
                <button class="decrease">-</button>
                <input type="text" value="1">
                <button class="increase">+</button>
            </div>
        </div>
    </div>
    <div class="productselect">
        <div class="onlyone">
            <input type="checkbox" name="secselect" class="orderitem">
            <div class="product-desc">
                <img src="https://plus.unsplash.com/premium_photo-1674389878114-6a5479a7b86c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="">
                <div class="desc">
                    <p>Donuts</p>
                    <p>no brand</p>
                    <p>only 10 items remaining</p>
                </div>
            </div>
        </div>
        <div class="price--qty">
            <div class="wish_price_del">
                <p>Rs: £20</p>
                <div>
                    <i class="fa-regular fa-heart show-heart"></i>
                    <i class="fa-solid fa-heart show-heart-solid"></i>
                    <i class="fa-solid fa-trash-can"></i>

                    <i></i>
                </div>
            </div>
            <div class="countitem">
                <button class="decrease">-</button>
              <input type="text" value="1">
              <button class="increase">+</button>
            </div>
        </div>
    </div>
</section>


<section class="oneitemselect">
    <div class="selectone">
        <div class="onlyone">
            <input type="checkbox" name="mainselectall" >
            <p>Uk Butcher shop</p>
        </div>
    </div>
    <div class="productselect">
        <div class="onlyone">
            <input type="checkbox" name="secselect" class="orderitem">
            <div class="product-desc">
                <img src="https://plus.unsplash.com/premium_photo-1674389878114-6a5479a7b86c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="">
                <div class="desc">
                    <p>Donuts</p>
                    <p>no brand</p>
                    <p>only 10 items remaining</p>
                </div>
            </div>
        </div>
        <div class="price--qty">
            <div class="wish_price_del">
                <p>Rs: £20</p>
                <div>
                    <i class="fa-regular fa-heart show-heart"></i>
                    <i class="fa-solid fa-heart show-heart-solid"></i>
                    <i class="fa-solid fa-trash-can"></i>

                    <i></i>
                </div>
            </div>
            <div class="countitem">
                <button class="decrease">-</button>
                <input type="text" value="1">
                <button class="increase">+</button>
            </div>
        </div>
    </div>
    <div class="productselect">
        <div class="onlyone">
            <input type="checkbox" name="secselect" class="orderitem">
            <div class="product-desc">
                <img src="https://plus.unsplash.com/premium_photo-1674389878114-6a5479a7b86c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="">
                <div class="desc">
                    <p>Donuts</p>
                    <p>no brand</p>
                    <p>only 10 items remaining</p>
                </div>
            </div>
        </div>
        <div class="price--qty">
            <div class="wish_price_del">
                <p>Rs: £20</p>
                <div>
                    <i class="fa-regular fa-heart show-heart"></i>
                    <i class="fa-solid fa-heart show-heart-solid"></i>
                    <i class="fa-solid fa-trash-can"></i>

                    <i></i>
                </div>
            </div>
            <div class="countitem">
                <button class="decrease">-</button>
              <input type="text" value="1">
              <button class="increase">+</button>
            </div>
        </div>
    </div>
</section>
-->


<section class="ordersummary">
    <div class="container-order">

        <p class="summary-head">Order summary</p>
        <div class="total">
            <p>Total:</p>
            <p class="ordercost">£0</p>
        </div>
        <div class="order-checkout">
            <button type="submit" class="checkout">Proceed to checkout</button>
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
